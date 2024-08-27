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

$clientphone = $_POST["clientphone"];
$clientphone = preg_replace('![^0-9]+!', '', $clientphone);

$clientemail = $_POST["clientemail"];
$clientnamefirst = $_POST["clientnamefirst"];
//$clientnamelast = $_POST["clientnamelast"];

$ordername = 'Заявка с квиза solid от ' . $clientnamefirst . '';
$customorder_tnazva = 'Заявка с квиза solid от ' . $clientnamefirst . ' ' . date("Y-m-d H:i:s") . ''; //костыль для передачи названия заявки

$utm_source = $_POST["utm_source"];
$utm_medium = $_POST["utm_medium"];
$utm_campaign = $_POST["utm_campaign"];
$utm_content = $_POST["utm_content"];
$utm_term = $_POST["utm_term"];
$customorder_utm_referrer = $_POST["customorder_utm_referrer"];


//steps
//$customorder_Icantunderstandthisemail = $_POST["step1"];
//$customorder_Haveyougottimetodiscussyourworknoworareyoutoleave = $_POST["step2"];
//$customorder_IleftmylastjobbecauseIhadnototravel = $_POST["step3"];

//$sendToCrm =      clientnamelast={$clientnamelast}  - this delete area

$sendToCrm = fopen("https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$ordercode}&clientphone={$clientphone}&clientemail={$clientemail}&clientnamefirst={$clientnamefirst}&ordername={$customorder_tnazva}&workflowid=2&statusid=5&utm_source={$utm_source}&utm_medium={$utm_medium}&utm_campaign={$utm_campaign}&utm_content={$utm_content}&utm_term={$utm_term}&utm_referrer={$customorder_utm_referrer}&customorder_tnazva={$customorder_tnazva}&order_managerid={$order_managerid}&source=КвизSolid","r");
//$sendToCrm = fopen("https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$ordercode}&clientphone={$clientphone}&clientemail={$clientemail}&clientnamefirst={$clientnamefirst}&ordername={$customorder_tnazva}&workflowid=2&statusid=5&utm_source={$utm_source}&utm_medium={$utm_medium}&utm_campaign={$utm_campaign}&utm_content={$utm_content}&utm_term={$utm_term}&utm_referrer={$customorder_utm_referrer}&customorder_tnazva={$customorder_tnazva}&order_managerid={$order_managerid}&source=КвизSolid","r");

$sendToCrmRequest = "https://solidenglishschool.1b.app/api/orders/add/?login={$login}&password={$password}&ordercode={$ordercode}&clientphone={$clientphone}&clientemail={$clientemail}&clientnamefirst={$clientnamefirst}&ordername={$customorder_tnazva}&workflowid=2&statusid=5&utm_source={$utm_source}&utm_medium={$utm_medium}&utm_campaign={$utm_campaign}&utm_content={$utm_content}&utm_term={$utm_term}&utm_referrer={$customorder_utm_referrer}&customorder_tnazva={$customorder_tnazva}&order_managerid={$order_managerid}&source=КвизSolid";

$openBoxResult = stream_get_contents($sendToCrm); // отчёт по доставке в openbox

// сюда нужно вписать токен вашего бота
define('TELEGRAM_TOKEN', '5851533305:AAEHXeCJ48NKCE2FJsFzmRgfxEJye5GqbkI');

// сюда нужно вписать ваш внутренний айдишник
define('TELEGRAM_CHATID', '-893257518');

message_to_telegram('
Зявка с квиза solid
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
//Полный запрос по URL имеет такой вид: ' . $sendToCrmRequest . '

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