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
	<title>
		<?php __('Career Days 2011'); ?>
		<?php echo $title_for_layout; ?>
	</title>
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
		<div id="header">
                    <div id="logo">
                        <?php echo $this->Html->image('logo-cd.png'); ?>
                    </div>
			<h1><?php echo $this->Html->link(__('Career Days 2011', true), 'http://www.careerdays.cz'); ?></h1>

                        <div id="topmenu">
                            <ul>
                                <?php
                                echo '<li>'.$this->Html->link(__('Úvod', true), array('controller' => 'students', 'action' => 'index')).'</li>';
                                if(!empty($user))
                                {
                                    echo '<li>'.$this->Html->link(__('Průvodce', true), array('controller' => 'students', 'action' => 'priprav_se')).'</li>';
                                    echo '<li>'.$this->Html->link(__('Profil & Agenda', true), array('controller' => 'students', 'action' => 'profil')).'</li>';
                                }
                                else
                                {
                                    echo '<li>'.$this->Html->link(__('Setkání s firmami', true), array('controller' => 'meetings', 'action' => 'student_index')).'</li>';
                                   // echo '<li>'.$this->Html->link(__('Tréninky', true), array('controller' => 'trainings', 'action' => 'student_index')).'</li>';
                                }
                                echo '<li>'.$this->Html->link(__('Doprovodný program', true), array('controller' => 'panel_discussions', 'action' => 'student_index')).'</li>';
                                if(empty($user))
                                {
                                    echo '<li>'.$this->Html->link(__('Firmy', true), array('controller' => 'companies', 'action' => 'student_index')).'</li>';
                                }
                                echo '<li>'.$this->Html->link(__('www.careerdays.cz', true), 'http://www.careerdays.cz').'</li>';
                                if(!empty($user))
                                {
                                    echo '<li>'.$this->Html->link(__('Odhlášení', true), array('controller' => 'users', 'action' => 'logout')).'</li>';
                                }
                                else
                                {
                                    echo '<li>'.$this->Html->link(__('Přihlášení', true), array('controller' => 'users', 'action' => 'login')).'</li>';
                                }
                                
                                ?>
                            </ul>
                        </div>
		</div>
		<div id="content-wrapper">
                    <?php
                    //pr($zobraz_menu);
//                    if(isset($zobraz_menu) && $zobraz_menu == true)
//                    {
//                        echo '<div id="menu">';
//                        if(isset($user))
//                            echo $this->Menu->show($user);
//                        echo '</div>';
//                    }
                    ?>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        $('#flashMessage.message').delay(4200).slideUp(1000);
                    });
                    </script>
                    <div id="content" <?php if(isset($zobraz_menu) && $zobraz_menu == false){echo 'class="nomenu"';} ?>>
			<?php echo $this->Session->flash('auth'); ?>
                        <?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
                    </div>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	
</body>
</html>