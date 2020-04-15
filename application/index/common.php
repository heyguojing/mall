<?php
/**发送手机注册码
 * @param $mobile
 * @param $code
 * @param string $template_id
 */
use Org\Util\Ucpaas;
if (!function_exists('send_sms')) {
    function send_sms ($mobile, $code, $template_id = "539608")
    {
        $config_data = array(
            'accountsid' => config('site.SMS_ACCOUNT_SID'),
            'token' => config('site.SMS_TOKEN'),
        );
        $ucpaas = new Ucpaas($config_data);
        $appid = config('site.SMS_APP_ID');
        //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
        $param = [$mobile, $code]; //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
        $uid = "";
        $res = $ucpaas->SendSms($appid, $template_id, $param, $mobile, $uid);
        return json_decode($res, true);
    }
}