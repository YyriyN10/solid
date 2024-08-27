<?
$login = '380996212409';
$password = '87b15a94a9581397670c193380efb3d2';

//generation id
$date = new DateTime();
$data = $date->getTimestamp();
$rand = rand(0, 9);
$data = $data - 1000000000;
$ordercode = $data . "-" . $rand;
//generation id



$order_managerid = 16; //id manager

$clientphone = $_POST["tel_user"]; //телефон клиента
$clientphone = preg_replace('![^0-9]+!', '', $clientphone);

$clientemail = $_POST["email_user"]; //почта клиента
$clientnamefirst = $_POST["name_user"];  //имя клиента

$ordername = 'Заявка с сайта solid ' . $clientnamefirst . ''; //заголовок сообщения

$customorder_tnazva = 'Заявка с сайта solid ' . $clientnamefirst . ' ' . date("Y-m-d H:i:s") . ''; //костыль для передачи названия заявки


$utm_source = $_POST["utm_source"];  //метки ютм
$utm_medium = $_POST["utm_medium"];
$utm_campaign = $_POST["utm_campaign"];
$utm_content = $_POST["utm_content"];
$utm_term = $_POST["utm_term"];
$customorder_utm_referrer = $_POST["customorder_utm_referrer"]; //урл страницы откуда отправлена заявка

//for page form https://solid.com.ua/form/ для передачи В срм передавать название сделки  InstForm в поле источник  [source] => InstForm
if($customorder_utm_referrer == 'https://solid.com.ua/form/'){
	$sendToCrm = fopen("https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$ordercode}&clientphone={$clientphone}&clientemail={$clientemail}&clientnamefirst={$clientnamefirst}&ordername={$customorder_tnazva}&workflowid=2&statusid=5&utm_source={$utm_source}&utm_medium={$utm_medium}&utm_campaign={$utm_campaign}&utm_content={$utm_content}&utm_term={$utm_term}&utm_referrer={$customorder_utm_referrer}&customorder_tnazva={$customorder_tnazva}&order_managerid={$order_managerid}&source=InstForm","r");
} else {
	$sendToCrm = fopen("https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$ordercode}&clientphone={$clientphone}&clientemail={$clientemail}&clientnamefirst={$clientnamefirst}&ordername={$customorder_tnazva}&workflowid=2&statusid=5&utm_source={$utm_source}&utm_medium={$utm_medium}&utm_campaign={$utm_campaign}&utm_content={$utm_content}&utm_term={$utm_term}&utm_referrer={$customorder_utm_referrer}&customorder_tnazva={$customorder_tnazva}&order_managerid={$order_managerid}&source=СайтSolid","r");
}

$openBoxResult = stream_get_contents($sendToCrm); // отчёт по доставке в openbox



//$sendToCrm = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");



// сюда нужно вписать токен вашего бота
define('TELEGRAM_TOKEN', '5851533305:AAEHXeCJ48NKCE2FJsFzmRgfxEJye5GqbkI');

// сюда нужно вписать ваш внутренний айдишник
define('TELEGRAM_CHATID', '-893257518');

message_to_telegram('
Зявка с solid.com.ua
Данные клиента
Имя клиента: ' . $clientnamefirst . '
Телефон клиента:
' . $clientphone . '
Почта клиента: 
' . $clientemail . '
' . $utm_source . ' ' . $utm_medium . ' ' . $utm_campaign . ' ' . $utm_content . ' ' . $utm_term . '
Заказ со страницы: ' . $customorder_utm_referrer . '
Отчёт по доставке в Onebox api: ' . $openBoxResult . '
');


function message_to_telegram($text)
{
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}

?>