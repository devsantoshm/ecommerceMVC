<?php  
class SlideController
{
	public function showSlide()
	{
		$table = "slide";
		$response = SlideModel::showSlide($table);

		return $response;
	}
}

?>