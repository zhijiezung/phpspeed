<?php namespace library;

/*
| phpspeed exception class
|--------------------------------------------------------------------------------------
| Author  : Peng Zeng
| www     : http://www.phpspeed.top
| version : 1.0
|--------------------------------------------------------------------------------------
*/
use Exception;

class appexception{

    // 注册系统错误捕获函数
    public static function system_error(){
        if($err = error_get_last()) self::out_error($err);
    }

    // 注册用户自定义错误捕获函数
    public static function app_error($errno, $errstr, $errfile, $errline){
//        self::out_error([
//            'message' => $errstr,
//            'file'    => $errfile,
//            'line'    => $errline,
//            'code'    => $errno,
//        ]);
    }

    // 注册用户抛出的异常错误捕获函数
    public static function app_exception(Exception $e){
        self::out_error([
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'code'    => $e->getCode(),
        ]);
    }

    // 输出错误信息
    public static function out_error( $e ){

        if(in_array($e['message'],[401,403,404,500]))
            self::error_code($e['message']);

        if(APP_DEBUG)
            exit(
                "Message : {$e['message']}<br />".
                "File : {$e['file']}<br />".
                "Line : {$e['line']}<br />".
                "Code : {$e['code']}"
            );

    }

    public static function error_code($code){
        switch($code){
            case 401 :
                header('HTTP/1.1 401 Unauthorized');
                break;
            case 403 :
                header('HTTP/1.1 403 Forbidden');
                break;
            case 404 :
                header('HTTP/1.1 404 Not Found');
                break;
            case 500 :
                header('HTTP/1.1 500 Internal Server Error');
                break;
        }
        exit;
    }

//1 E_ERROR 致命的运行错误。错误无法恢复，暂停执行脚本。
//2 E_WARNING 运行时警告(非致命性错误)。非致命的运行错误，脚本执行不会停止。
//4 E_PARSE 编译时解析错误。解析错误只由分析器产生。
//8 E_NOTICE 运行时提醒(这些经常是你代码中的bug引起的，也可能是有意的行为造成的。)
//16 E_CORE_ERROR PHP启动时初始化过程中的致命错误。
//32 E_CORE_WARNING PHP启动时初始化过程中的警告(非致命性错)。
//64 E_COMPILE_ERROR 编译时致命性错。这就像由Zend脚本引擎生成了一个E_ERROR。
//128 E_COMPILE_WARNING 编译时警告(非致命性错)。这就像由Zend脚本引擎生成了一个E_WARNING警告。
//256 E_USER_ERROR 用户自定义的错误消息。这就像由使用PHP函数trigger_error（程序员设置E_ERROR）
//512 E_USER_WARNING 用户自定义的警告消息。这就像由使用PHP函数trigger_error（程序员设定的一个E_WARNING警告）
//1024 E_USER_NOTICE 用户自定义的提醒消息。这就像一个由使用PHP函数trigger_error（程序员一个E_NOTICE集）
//2048 E_STRICT 编码标准化警告。允许PHP建议如何修改代码以确保最佳的互操作性向前兼容性。
//4096 E_RECOVERABLE_ERROR 开捕致命错误。这就像一个E_ERROR，但可以通过用户定义的处理捕获（又见set_error_handler（））
//8191 E_ALL 所有的错误和警告(不包括 E_STRICT) (E_STRICT will be part of E_ALL as of PHP 6.0)

}