<?php
/**
* 
* @Author: 	dynamic-动态
* @Web: 	阿西里西
* @Url: 	http://www.axlix.com
* @DateTime: 	2017-06-07 09:23:43
* @Desc: 	发送邮件类库
*
*/
namespace phpmailer;
use phpmailer\Phpmailer;
use think\Exception;
/**
* SMTP邮件发送
*/
class Email
{
	
	/**
	 * [send 发邮件]
	 * @param  [type] $to      [要发到那个邮件]
	 * @param  [type] $title   [标题]
	 * @param  [type] $content [内容]
	 * @return [type] return   [bool]
	 */
	public static function send($to,$title,$content){
		//SMTP需要准确的时间，PHP时区必须设置
		date_default_timezone_set('PRC');
		if (empty($to)) {
			return false;
		}
		/*抛异常*/
		try{
			//创建phpmailer实例
			$mail = new PHPMailer;
			//设置SMTP方法
			$mail->isSMTP();
			//启用SMTP调试
			// 0 = 关闭 (生产使用)
			// 1 = 客户端的消息
			// 2 = 客户端和服务端的消息
			$mail->SMTPDebug = config('site.EMAIL_SMTP_DEBUG');
			//请求HTML友好的调试输出
			$mail->Debugoutput = config('site.EMAIL_DEBUG_OUTPUT');;
			//设置邮件服务器的主机名
			$mail->Host = config('site.EMAIL_HOST');
			//设置SMTP端口号-可能是25，465或587
			$mail->SMTPSecure = config('site.EMAIL_SMTP_SECURE');
			// 设置ssl连接smtp服务器的远程服务器端口号
			$mail->Port = config('site.EMAIL_PORT');
			// 是否使用SMTP认证 
			$mail->SMTPAuth = config('site.EMAIL_SMTP_AUTH');
			// 用于SMTP身份验证的用户名 
			$mail->Username = config('site.EMAIL_USERNAME');
			// 用于SMTP身份验证的密码 (非登陆密码哟)
			$mail->Password = config('site.EMAIL_PASSWORD');
			//设置消息是从谁发送 (填写SMTP身份验证的用户名)
			$mail->setFrom(config('site.EMAIL_SETFROM_ADDRESS'), config('site.EMAIL_SETFROM_NAME'));
			//设置回复邮箱地址
			$mail->addReplyTo(config('site.EMAIL_SETFROM_NAME'),config('site.EMAIL_ADDREPLY_TO_NAME'));
			//设置要发送给谁
			$mail->addAddress($to);
			//设置发送的主题
			$mail->Subject = $title;
			//从外部文件读取HTML消息体，将引用的图像转换为嵌入式， 
			// 将HTML转换为基本的纯文本替代体 
			$mail->msgHTML($content);
			//手动替换纯文本正文
			$mail->AltBody = 'This is a plain-text message body';
			//附加图像文件
			//$mail->addAttachment('phpmailer_mini.png');

			// 发送消息，检查错误 
			if (!$mail->send()) {
				return false;
			    //echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    return true;
			}
		}catch(phpmailerException $e){
			return false;
		}
	}


}