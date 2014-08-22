<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
            <meta http-equiv="refresh" content="600" />
	<?php
		echo $this->Html->meta('icon');

                echo $this->Html->script('jquery-1.4.4.min');
                echo $this->Html->script('jquery-ui/jquery-ui-1.8.8.custom.min');
                echo $this->Html->css('jquery-ui/overcast/jquery-ui-1.8.8.custom');
                echo $this->Html->script('pnotify/jquery.pnotify.min');
                echo $this->Html->css('pnotify/jquery.pnotify.default');
                echo $this->Html->css('pnotify/jquery.pnotify.default.icons');
		echo $this->Html->css('cake.generic.student');
                echo $this->Html->script('fancybox/jquery.fancybox-1.3.4');
                echo $this->Html->css('fancybox/jquery.fancybox-1.3.4');

		echo $scripts_for_layout;
	?>
            
</head>
<body>
	<div id="container">
		<div id="content-wrapper">
                    
                    <div id="content">
			<?php echo $this->Session->flash('auth'); ?>
                        <?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
                    </div>

		</div>
	</div>
	
</body>
</html>