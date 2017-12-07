<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial_model extends CI_Model
{
	// Testimonial Functions //
	// Testimonial Show
	public function getTestimonialALL()
	{	
		$result = $this->db->get('testimonial');
		return $result;
	}
	// Testimonial Show End

}