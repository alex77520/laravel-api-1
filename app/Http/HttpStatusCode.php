<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/3/18
 * Time: 下午11:52
 */

namespace App\Http;

class HttpStatusCode
{
	// RestfulApi常用HTTP状态码
	const HTTP_OK                     = 200; // 操作成功
	const HTTP_CREATED                = 201; // 对象创建成功
	const HTTP_ACCEPTED               = 202; // 请求已经被接受
	const HTTP_NO_CONTENT             = 204; // 操作已经执行成功,但是没有返回数据
	const HTTP_MOVED_PERMANENTLY      = 301; // 资源已经被移除
	const HTTP_SEE_OTHER              = 303; // 重定向
	const HTTP_NOT_MODIFY             = 304; // 资源没有被修改
	const HTTP_BAD_REQUEST            = 400; // 参数列表错误(缺少,格式不匹配)
	const HTTP_UNAUTHORIZED           = 401; // 未授权
	const HTTP_FORBIDDEN              = 403; // 访问受限,授权过期
	const HTTP_NOT_FOUND              = 404; // 资源,服务未找到
	const HTTP_METHOD_NOT_ALLOWED     = 405; // 不允许的http方法
	const HTTP_CONFLICT               = 409; // 资源冲突,或者资源被锁定
	const HTTP_UNSUPPORTED_MEDIA_TYPE = 415; // 不支持的数据(媒体)类型
	const HTTP_TOO_MANY_REQUEST       = 429; // 请求过多被限制
	const HTTP_INTERNAL_SERVER_ERROR  = 500; // 系统内部错误ß
	const HTTP_NOT_IMPLEMENTED        = 501; //接口未实现

}