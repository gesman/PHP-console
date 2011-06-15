<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP console</title>

<style type="text/css">
.courier {
    font-family: 'Courier New', Courier, monospace;
    }
.smaller {
    font-size:12px;
    font-weight:bold;
    width:40px;
    }
</style>
</head>

<body>
<?php
    $php_output = "";
    if (!isset($_POST['format_output']) || $_POST['format_output'])
        $checkbox__format_output = 'checked="checked"';
    else
        $checkbox__format_output = '';

    if (@$_POST['php_input'])
        {
        ob_start();
        eval($_POST['php_input']);
        $php_output = ob_get_contents();
        ob_end_clean();

        if (@$_POST['format_output'])
            {
            $php_output = str_replace (" ", '&nbsp;', $php_output);
            $php_output = str_replace ("\n", "<br />", $php_output);
            }
        }
    else
        {
        $_POST['php_input'] = '$arr = array(1, "Hello <i>World</i>!", "abc"=>234);'."\n".'print_r($arr);';
        }


?>
<div align="center" style="margin-top:30px;">
<form action="http://php.net/search.php" method="get" target="_blank">
<input name="show" type="hidden" value="quickref" />
  <label for="pattern">Search PHP.NET for [function]:&nbsp;&nbsp;</label>
  <input name="pattern" type="text" id="pattern" size="30" />&nbsp; <input name="submit" type="submit" value="Search PHP.NET ..." />
</form>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div style="margin:5px 0;">Type PHP code to execute:</div>
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td width="8%" align="right" valign="top"><div class="courier smaller">&lt;?php</div></td>
            <td width="84%" align="center" valign="middle"><textarea name="php_input" cols="100" rows="15"><?php echo @$_POST['php_input']; ?></textarea></td>
            <td width="8%" align="left" valign="bottom"><div class="courier smaller">?&gt;</div></td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="middle"><input name="button" type="submit" value="Execute!" /></td>
          </tr>
          <tr>
            <td colspan="3" align="center" valign="middle">Format output (replace newlines with &lt;br /&gt; and spaces with &amp;nbsp;):
              <input type="hidden" name="format_output" value="0" /><input name="format_output" type="checkbox" value="1" <?php echo $checkbox__format_output; ?> />
            <label for="checkbox"></label></td>
          </tr>
          <tr>
            <td></td>
            <td align="center" valign="middle">
                <div class="courier" style="border:2px solid #DDD;background-color:#FFD;padding:10px;text-align:left;font-size:13px;">
                    <?php echo $php_output; ?><br />
                </div>
            </td>
            <td></td>
          </tr>
        </table>
      <div></div>


    </form>
</div>
</body>
</html>