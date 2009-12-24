<?php
/*
Plugin Name: ICRA Label Generator
Plugin URI: http://smheart.org/icra-label-generator/
Description: This plugin generates the appropriate ICRA ratings for your WordPress site and integrates the information into your site.
Author: Matthew Phillips
Version: 1.0
Author URI: http://smheart.org


Copyright 2009 SMHeart Inc, Matthew Phillips  (email : matthew@smheart.org)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

http://www.gnu.org/licenses/gpl.txt

Version
        1.0 - 19 December 2009


*/

add_action('admin_menu', 'icralabelgen_menu');
add_action('admin_head', 'icralabelgen_styles');
add_action('wp_head', 'icraheader_insert');
register_activation_hook(__FILE__, 'icralabelgen_activation');
register_activation_hook(__FILE__, 'icralabelgen_install');

function icralabelgen_install() {
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	}

function icralabelgen_menu() {
	add_options_page('ICRA Label Generator', 'ICRA Label Gen', 8, __FILE__, 'icralabelgen_options');
	}

function icralabelgen_styles() {
	?>
 	<link rel="stylesheet" href="/wp-content/plugins/icra-label-generator/icra-label-generator.css" type="text/css" media="screen" charset="utf-8"/>
	<?php
	}

function icraheader_insert() {
	?>
	<link rel="meta" href="<?php bloginfo(url); ?>/icralabels.xml" type="application/rdf+xml" title="ICRA labels" />
	<?php
}

function icralabelgen_options() {
	?>

	<div class="wrap">
		<h2>ICRA Label Generator V1.0</h2>
		<div id="icra_main">
			<div id="icra_left_wrap">
				<div id="icra_left_inside">
					<h3>Donate</h3>
					<p><em>If you like this plugin and find it useful, help keep this plugin free and actively developed by clicking the <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10657271" target="paypal"><strong>donate</strong></a> button or send me a gift from my <a href="http://amzn.com/w/11GK2Q9X1JXGY" target="amazon"><strong>Amazon wishlist</strong></a>.  Also follow me on <a href="http://twitter.com/kestrachern/" target="twitter"><strong>Twitter</strong></a>.</em></p>
					<a target="paypal" title="Paypal Donate"href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10657271"><img src="/wp-content/plugins/hellotxt/paypal.jpg" alt="Donate with PayPal" /></a>
					<a target="amazon" title="Amazon Wish List" href="http://amzn.com/w/11GK2Q9X1JXGY"><img src="/wp-content/plugins/hellotxt/amazon.jpg" alt="My Amazon wishlist" /> </a>
					<a target="Twitter" title="Follow me on Twitter" href="http://twitter.com/kestrachern/"><img src="/wp-content/plugins/hellotxt/twitter.jpg" alt="Twitter" /></a>	
				</div>
			</div>
			<div id="icra_right_wrap">
				<div id="icra_right_inside">
				<h3>About the Plugin</h3>
				<p> The plugin sends a message to the HelloTXT social notification network when a post is published in WordPress.</p>
				</div>
			</div>
		</div>
	<div style="clear:both;"></div>

	<fieldset class="options"><legend>ICRA Label Generator Options</legend> 
	<?php if (stripslashes($_POST['whichForm'])!="icra"){
      		$me = $_SERVER['PHP_SELF'].'?page=icra-label-generator/icra-label-generator.php';?>

  <form method="post" action="<?php echo $me;?>" id="icralabelgenform" name="icralabelgenform" onSubmit="return agreeterms()" >
  <h3>Choose at least one descriptor per section.</h3>
<p>Please indicate which of the following are present on the site to be labelled, either directly, or in images, portrayals or descriptions. A valid ICRA label will always include at least one descriptor from each section of the vocabulary except the context modifiers which are always optional. If no descriptors are checked within a given section, the label generator will insert a label that declares that material described in that section may be, but is not known to be, present.</p>
<fieldset class="selectors" id="qn" title="Nudity Content Selectors"><a name="qn"></a>
	<legend>Nudity [<a class="icradescription" title="Click for Help!" onclick="toggleVisibility('nudity');">Help</a>]</legend>
	<div class="icradescriptiontext" id="nudity">
	<p>The nudity descriptors stand alone and do not of themselves imply any sexual context.</p>
	</div>
	<input type="checkbox" name="na" id="na" /><label for="na">Exposed breasts</label><br/>
	<input type="checkbox" name="nb" id="nb" /><label for="nb">Bare buttocks</label><br/>
	<input type="checkbox" name="nc" id="nc" /><label for="nc">Visible genitals</label><br/>
	<input type="checkbox" name="nz" id="nz" /><label for="nz">None of the above</label><br/>
</fieldset>

<fieldset class="selectors" id="qs" title="Sexual Material Content Selectors"><a name="qs"></a>
	<legend>Sexual material [<a class="icradescription" title="Click for Description!" onclick="toggleVisibility('sexualmaterial');">Help</a>]</legend>
	<div class="icradescriptiontext" id="sexualmaterial">
	<p>The term Erotica is included in the vocabulary to cover material that is sex-related but does not show sexual activity. Examples include sexually provocative clothing, provocative sex poses and sex toys.</p>
	</div>
	<input type="checkbox" name="sa" id="sa" /><label for="sa">Passionate kissing</label><br />
	<input type="checkbox" name="sb" id="sb" /><label for="sb">Obscured or implied sexual acts</label><br />
	<input type="checkbox" name="sc" id="sc" /><label for="sc">Visible sexual touching</label><br />
	<input type="checkbox" name="sd" id="sd" /><label for="sd">Explicit sexual language</label><br />
	<input type="checkbox" name="se" id="se" /><label for="se">Erections/explicit sexual acts</label><br />
	<input type="checkbox" name="sf" id="sf" /><label for="sf">Erotica</label><br />
	<input type="checkbox" name="sz" id="sz" /><label for="sz">None of the above</label><br />
</fieldset>

<fieldset class="selectors" id="qv" title="Violence Content Selectors"><a name="qv"></a>
	<legend>Violence [<a class="icradescription" title="Click for Description!" onclick="toggleVisibility('violence');">Help</a>]</legend>
	<div class="icradescriptiontext" id="violence">
	<p>It is believed that no further explanation is required to support the descriptors in this section.</p>
	</div>
	<input type="checkbox" name="va" id="va" /><label for="va">Assault/rape</label><br />
	<input type="checkbox" name="vb" id="vb" /><label for="vb">Injury to human beings</label><br />
	<input type="checkbox" name="vc" id="vc" /><label for="vc">Injury to animals</label><br />
	<input type="checkbox" name="vd" id="vd" /><label for="vd">Injury to fantasy characters (including animation)</label><br />
	<input type="checkbox" name="ve" id="ve" /><label for="ve">Blood and dismemberment, human beings</label><br />
	<input type="checkbox" name="vf" id="vf" /><label for="vf">Blood and dismemberment, animals</label><br />
	<input type="checkbox" name="vg" id="vg" /><label for="vg">Blood and dismemberment, fantasy characters (including animation)</label><br />
	<input type="checkbox" name="vh" id="vh" /><label for="vh">Torture or killing of human beings</label><br />
	<input type="checkbox" name="vi" id="vi" /><label for="vi">Torture or killing of animals</label><br />
	<input type="checkbox" name="vj" id="vj" /><label for="vj">Torture or killing of fantasy characters (including animation)</label><br />
	<input type="checkbox" name="vz" id="vz"/><label for="vz">None of the above</label><br />
</fieldset>

<fieldset class="selectors" id="ql" title="Language Content Selectors"><a name="ql"></a>
	<legend>Language [<a class="icradescription" title="Click for Description!" onclick="toggleVisibility('language');">Help</a>]</legend>
	<div class="icradescriptiontext" id="language">
	<p>No further definition is given since, by its very nature, language and the perception of language is always changing.</p>
	</div>
	<input type="checkbox" name="la" id="la" /><label for="la">Abusive or vulgar terms</label><br />
	<input type="checkbox" name="lb" id="lb" /><label for="lb">Profanity or swearing</label><br />
	<input type="checkbox" name="lc" id="lc" /><label for="lc">Mild expletives</label><br />
	<input type="checkbox" name="lz" id="lz"/><label for="lz">None of the above</label><br />
</fieldset>

<fieldset class="selectors" id="qo" title="Potentially Harmful Activities Content Selectors"><a name="qo"></a>
	<legend>Potentially harmful activities [<a class="icradescription" title="Click for Description!" onclick="toggleVisibility('potentiallyharmfulactivities');">Help</a>]</legend>
	<div class="icradescriptiontext" id="potentiallyharmfulactivities">
	<p>It is believed that no further explanation is required to support the descriptors in this section.</p>
	</div>
	<input type="checkbox" name="oa" id="oa" /><label for="oa">Depiction of tobacco use</label><br />
	<input type="checkbox" name="ob" id="ob" /><label for="ob">Depiction of alcohol use</label><br />
	<input type="checkbox" name="oc" id="oc" /><label for="oc">Depiction of drug use</label><br />
	<input type="checkbox" name="od" id="od" /><label for="od">Depiction of the use of weapons</label><br />
	<input type="checkbox" name="oe" id="oe" /><label for="oe">Gambling</label><br />
	<input type="checkbox" name="of" id="of" /><label for="of">Content that sets a bad example for young children: that teaches or encourages children to perform harmful acts or imitate dangerous behaviour</label><br />
	<input type="checkbox" name="og" id="og" /><label for="og">Content that creates feelings of fear, intimidation, horror, or psychological terror</label><br />
	<input type="checkbox" name="oh" id="oh" /><label for="oh">Incitement or depiction of discrimination or harm against any individual or group based on gender, sexual orientation, ethnic, religious or national identity</label><br />
	<input type="checkbox" name="oz" id="oz"/><label for="oz">None of the above</label><br />
</fieldset>

<fieldset class="selectors" id="qc" title="User Generated Content Content Selectors"><a name="qc"></a>
	<legend>User generated content [<a class="icradescription" title="Click for Description!" onclick="toggleVisibility('usergeneratedcontent');">Help</a>]</legend>
	<div class="icradescriptiontext" id="usergeneratedcontent">
	<p>If you operate a chatroom, host a message board or any other method by which users can directly post content to your site, you should check one or other of the two descriptors in this section. "Moderated" means that you review user-supplied content before it is posted to the web.</p>
	</div>
	<input type="checkbox" name="ca" id="ca" /><label for="ca">User-generated content such as chat rooms and message boards (moderated)</label><br />
	<input type="checkbox" name="cb" id="cb" /><label for="cb">User-generated content such as chat rooms and message boards (unmoderated)</label><br />
	<input type="checkbox" name="cz" id="cz"/><label for="cz">None of the above</label><br />
</fieldset>

<fieldset class="selectors" id="qx" title="Context Content Selectors"><a name="qx"></a>
	<legend>Context [<a class="icradescription" title="Click for Description!" onclick="toggleVisibility('context');">Help</a>]</legend>
	<div class="icradescriptiontext" id="context">
	<p>The context descriptors allow providers to make a statement about the intention behind their content.</p>
	<p><strong>This material appears in a context intended to be artistic, medical or educational</strong> - 
Classical painting and sculpture can be assumed to be intended as artistic. Material designed to teach children about sex would qualify as intended to be educational<br />
<strong>This material appears in a sports context.</strong> - 
This context qualifier is provided with contact sports in mind, such as boxing. It is not intended, for example, to cover violent online or video games.<br />
<strong>This material appears in a news context</strong> -
This context qualifier is provided to describe material that reports real life events that in other contexts may be considered harmful by parents.</p>
	</div>
	<input type="checkbox" name="xa" id="xa" /><label for="xa">This material appears in an artistic context</label><br />
	<input type="checkbox" name="xb" id="xb" /><label for="xb">This material appears in an educational context</label><br />
	<input type="checkbox" name="xc" id="xc" /><label for="xc">This material appears in a medical context</label><br />
	<input type="checkbox" name="xd" id="xd" /><label for="xd">This material appears in a sports context</label><br />
	<input type="checkbox" name="xe" id="xe"  /><label for="xe">This material appears in a news context</label><br />
</fieldset>

<fieldset class="selectors">
 <label for="agree_terms"> You agree to ICRA Terms and Conditions</label> (<a>see below</a>). <input type="checkbox" name="agree_terms" id="agree_terms"  /><br />
<input type="reset" value="Clear Form"/><input type="submit" name="submit" value="Create ICRA Labels" id="icrasubmitbutton"/>
</fieldset>
<input type="hidden" name="whichForm" value="icra" />
  </form>



<?php
   } else {

	if (stripslashes($_POST['whichForm'])=="icra"){
$header = '<?xml version="1.0" encoding="iso-8859-1"?>
<rdf:RDF
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:dcterms="http://purl.org/dc/terms/"
  xmlns:label="http://www.w3.org/2004/12/q/contentlabel#"
  xmlns:icra="http://www.icra.org/rdfs/vocabularyv03#">

  <rdf:Description rdf:about="">
    <dc:creator rdf:resource="http://www.icra.org" />
    <dcterms:issued>'.date('Y-m-d').'</dcterms:issued>
    <label:authorityFor>http://www.icra.org/rdfs/vocabularyv03#</label:authorityFor>
  </rdf:Description>

  <label:Ruleset>
    <label:hasHostRestrictions>
      <label:Hosts>
        <label:hostRestriction>'.get_bloginfo(url).'</label:hostRestriction>
      </label:Hosts>
    </label:hasHostRestrictions>
    <label:hasDefaultLabel rdf:resource="#label_1" />
  </label:Ruleset>

  <label:ContentLabel rdf:ID="label_1">
    <rdfs:comment>Label for all/most of website</rdfs:comment>
';
$rfds='    <rdfs:label>';
if (isset($_POST['nz'])){$icra =$icra.'    <icra:nz>1</icra:nz>
';$rfds=$rfds.'No nudity; ';}
else {
if (isset($_POST['na'])){$icra =$icra.'    <icra:na>1</icra:na>
'; $rfds=$rfds.'Exposed breasts; ';}
if (isset($_POST['nb'])){$icra =$icra.'    <icra:nb>1</icra:nb>
'; $rfds=$rfds.'Bare buttocks; ';}
if (isset($_POST['nc'])){$icra =$icra.'    <icra:nc>1</icra:nc>
'; $rfds=$rfds.'Visible genitals; ';}
}
if (isset($_POST['sz'])){$icra =$icra.'    <icra:sz>1</icra:sz>
'; $rfds=$rfds.'No sexual material; ';}
else {
if (isset($_POST['sa'])){$icra =$icra.'    <icra:sa>1</icra:sa>
'; $rfds=$rfds.'Passionate kissing; ';}
if (isset($_POST['sb'])){$icra =$icra.'    <icra:sb>1</icra:sb>
'; $rfds=$rfds.'Obscured or implied sexual acts; ';}
if (isset($_POST['sc'])){$icra =$icra.'    <icra:sc>1</icra:sc>
'; $rfds=$rfds.'Visible sexual touching; ';}
if (isset($_POST['sd'])){$icra =$icra.'    <icra:sd>1</icra:sd>
'; $rfds=$rfds.'Explicit sexual language; ';}
if (isset($_POST['se'])){$icra =$icra.'    <icra:se>1</icra:se>
'; $rfds=$rfds.'Erections/explicit sexual acts; ';}
if (isset($_POST['sf'])){$icra =$icra.'    <icra:sf>1</icra:sf>
'; $rfds=$rfds.'Erotica; ';}
}
if (isset($_POST['vz'])){$icra =$icra.'    <icra:vz>1</icra:vz>
'; $rfds=$rfds.'No violence; ';}
else {
if (isset($_POST['va'])){$icra =$icra.'    <icra:va>1</icra:va>
'; $rfds=$rfds.'Assault/rape; ';}
if (isset($_POST['vb'])){$icra =$icra.'    <icra:vb>1</icra:vb>
'; $rfds=$rfds.'Injury to human beings; ';}
if (isset($_POST['vc'])){$icra =$icra.'    <icra:vc>1</icra:vc>
'; $rfds=$rfds.'Injury to animals; ';}
if (isset($_POST['vd'])){$icra =$icra.'    <icra:vd>1</icra:vd>
'; $rfds=$rfds.'Injury to fantasy characters (including animation); ';}
if (isset($_POST['ve'])){$icra =$icra.'    <icra:ve>1</icra:ve>
'; $rfds=$rfds.'Blood and dismemberment, human beings; ';}
if (isset($_POST['vf'])){$icra =$icra.'    <icra:vf>1</icra:vf>
'; $rfds=$rfds.'Blood and dismemberment, animals; ';}
if (isset($_POST['vg'])){$icra =$icra.'    <icra:vg>1</icra:vg>
'; $rfds=$rfds.'Blood and dismemberment, fantasy characters (including animation); ';}
if (isset($_POST['vh'])){$icra =$icra.'    <icra:vh>1</icra:vh>
'; $rfds=$rfds.'Torture or killing of human beings; ';}
if (isset($_POST['vi'])){$icra =$icra.'    <icra:vi>1</icra:vi>
'; $rfds=$rfds.'Torture or killing of animals; ';}
if (isset($_POST['vj'])){$icra =$icra.'    <icra:vj>1</icra:vj>
'; $rfds=$rfds.'Torture or killing of fantasy characters (including animation); ';}
}
if (isset($_POST['lz'])){$icra =$icra.'    <icra:lz>1</icra:lz>
'; $rfds=$rfds.'No potentially offensive language; ';}
else {
if (isset($_POST['la'])){$icra =$icra.'    <icra:la>1</icra:la>
'; $rfds=$rfds.'Abusive or vulgar terms; ';}
if (isset($_POST['lb'])){$icra =$icra.'    <icra:lb>1</icra:lb>
'; $rfds=$rfds.'Profanity or swearing; ';}
if (isset($_POST['lc'])){$icra =$icra.'    <icra:lc>1</icra:lc>
'; $rfds=$rfds.'Mild expletives; ';}
}
if (isset($_POST['oz'])){$icra =$icra.'    <icra:oz>1</icra:oz>
'; $rfds=$rfds.'No potentially harmful activities; ';}
else {
if (isset($_POST['oa'])){$icra =$icra.'    <icra:oa>1</icra:oa>
'; $rfds=$rfds.'Depiction of tobacco use; ';}
if (isset($_POST['ob'])){$icra =$icra.'    <icra:ob>1</icra:ob>
'; $rfds=$rfds.'Depiction of alcohol use; ';}
if (isset($_POST['oc'])){$icra =$icra.'    <icra:oc>1</icra:oc>
'; $rfds=$rfds.'Depiction of drug use; ';}
if (isset($_POST['od'])){$icra =$icra.'    <icra:od>1</icra:od>
'; $rfds=$rfds.'Depiction of the use of weapons; ';}
if (isset($_POST['oe'])){$icra =$icra.'    <icra:oe>1</icra:oe>
'; $rfds=$rfds.'Gambling; ';}
if (isset($_POST['of'])){$icra =$icra.'    <icra:of>1</icra:of>
'; $rfds=$rfds.'Content that sets a bad example for young children: that teaches or encourages children to perform harmful acts or imitate dangerous behaviour; ';}
if (isset($_POST['og'])){$icra =$icra.'    <icra:og>1</icra:og>
'; $rfds=$rfds.'Content that creates feelings of fear, intimidation, horror, or psychological terror; ';}
if (isset($_POST['oh'])){$icra =$icra.'    <icra:oh>1</icra:oh>
'; $rfds=$rfds.'Incitement or depiction of discrimination or harm against any individual or group based on gender, sexual orientation, ethnic, religious or national identity; ';}
}
if (isset($_POST['cz'])){$icra =$icra.'    <icra:cz>1</icra:cz>
'; $rfds=$rfds.'No user-generated content; ';}
else {
if (isset($_POST['ca'])){$icra =$icra.'    <icra:ca>1</icra:ca>
'; $rfds=$rfds.'User-generated content such as chat rooms and message boards (moderated); ';}
if (isset($_POST['cb'])){$icra =$icra.'    <icra:cb>1</icra:cb>
'; $rfds=$rfds.'User-generated content such as chat rooms and message boards (unmoderated); ';}
}
if (isset($_POST['xa'])){$icra =$icra.'    <label:hasModifier><icra:xa /></label:hasModifier>
'; $rfds=$rfds.'This material appears in an artistic context; ';}
if (isset($_POST['xb'])){$icra =$icra.'    <label:hasModifier><icra:xb /></label:hasModifier>
'; $rfds=$rfds.'This material appears in an educational context; ';}
if (isset($_POST['xc'])){$icra =$icra.'    <label:hasModifier><icra:xc /></label:hasModifier>
'; $rfds=$rfds.'This material appears in a medical context; ';}
if (isset($_POST['xd'])){$icra =$icra.'    <label:hasModifier><icra:xd /></label:hasModifier>
'; $rfds=$rfds.'This material appears in a sports context; ';}
if (isset($_POST['xe'])){$icra =$icra.'    <label:hasModifier><icra:xe /></label:hasModifier>
'; $rfds=$rfds.'This material appears in a news context; ';}
$rfds=$rfds."</rdfs:label>
";
$footer = "  </label:ContentLabel>

</rdf:RDF>";
$stringData=$header.$icra.$rfds.$footer;
$myFile = ABSPATH."icra_label.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh,$stringData."\t");
fclose($fh);
echo 'Your ICRA Label file was successfully created';
}

}?>
</fieldset>



	<div style="clear:both;"></div>			
	<fieldset class="options"><legend>Feature Suggestion/Bug Report</legend> 
	<?php if (stripslashes($_POST['whichForm'])!="support"){
      		$me = $_SERVER['PHP_SELF'].'?page=icra-label-generator/icra-label-generator.php';
		?>
		<form name="form1" method="post" action="<?php echo $me;?>">
		<table border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td>
				Make a:
			</td>
			<td>
				<select name="MessageType">
				<option value="Feature Suggestion">Feature Suggestion</option>
				<option value="Bug Report">Bug Report</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Name:
			</td>
			<td>
				<input type="text" name="Name">
			</td>
		</tr>
		<tr>
			<td>
				Your email:
			</td>
			<td>
				<input type="text" name="Email" value="<?php echo(get_option('admin_email')) ?>" />
			</td>
		</tr>
		<tr>
			<td valign="top">
				Message:
			</td>
			<td>
				<textarea name="MsgBody"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td>
				<input type="submit" name="Submit" value="Send">
			</td>
		</tr>
		</table>
<input type="hidden" name="whichForm" value="support" />

	</form>
<?php
   } else {
	if (stripslashes($_POST['whichForm'])=="support"){
      error_reporting(0);
	$recipient = 'support@smheart.org';
	$subject = stripslashes($_POST['MessageType']).'- ICRA Label Generator Plugin';
	$name = stripslashes($_POST['Name']);
	$email = stripslashes($_POST['Email']);
	if ($from == "") {
		$from = get_option('admin_email');
	}
	$header = "From: ".$name." <".$from.">\r
."."Reply-To: ".$from." \r
"."X-Mailer: PHP/" . phpversion();
	$msg = stripslashes($_POST['MsgBody']);
      if (mail($recipient, $subject, $msg, $header))
         echo nl2br("<h2>Message Sent:</h2>
         <strong>To:</strong> ICRA Label Generator Plugin Suport
         <strong>Subject:</strong> $subject
         <strong>Message:</strong> $msg");
      else
         echo "<h2>Message failed to send</h2>";
	}
}
?>
	</fieldset>			
	</div>






<script type="text/javascript">
<!--
    function toggleVisibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }

function agreeterms(){
  if (agree_terms.checked == 1)
    return true;
  else
    alert("You must agree to the terms and conditions before creating your labels")
    return false; 
}



//-->
</script>

	<?php
}
