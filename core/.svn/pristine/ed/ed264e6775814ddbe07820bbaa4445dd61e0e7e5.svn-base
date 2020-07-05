<?php
namespace core\component\Dompdf;

use core\component\Dompdf\src\Dompdf;
use core\component\Dompdf\src\Options;


require_once __DIR__ . DIRECTORY_SEPARATOR.'autoload.inc.php';

/**
 * Description of domPdf
 *
 * @author fabiosantana.santos
 */
class AbrirComoPdf {

    
    
    static public function domPdf($html,$nomeArquivo = 'arquivo') {
        
        try {
            $dompdf = new Dompdf();
           $dompdf->loadHtml($html);

           $dompdf->setPaper('A4', 'landscape');

           $options = $dompdf->getOptions();
           $options->set(array('isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true));
           $dompdf->setOptions($options);            
           
           $dompdf->render();

           $dompdf->stream($nomeArquivo, array(
               "Attachment" => false));
			   
        } catch (Exception $e) {
            
            var_dump($e);die;
// Do something here with $e and notify the user of the error in whatever way you see fit
        }
    }
}