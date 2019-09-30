<?php
session_start();
if(session_destroy()) // Menghapus Sessions
{
	header("Location: /osis"); // Langsung mengarah ke Home
}
?>