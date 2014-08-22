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
        echo $this->Html->css('cake.generic.vstupenka');
    ?>
</head>
<body>
    <table id="vstupenka">
        <tr>
            <td>
                <?php echo $this->Html->image('logo-cd.png');?>
            </td>
            <td>
                <h1>VSTUPENKA</h1>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php echo $content_for_layout; ?>
            </td>
        </tr>
    </table>
</body>
</html>