
<response>
	<sms message="<?php
            $out = __("SMS byla uspesne prijata. Vas registracni kod je %KOD%. Tento kod zadejte po vyzadani na www.careerdays.cz.", true);
            $out = str_replace('%KOD%', $key, $out);
            echo $out;
        ?>"/>
</response>