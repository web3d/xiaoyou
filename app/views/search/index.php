<?php
$title = '找人';
$no_sidebar = true;
$stylesheets = array('bootstrap.min', 'tweets','articles');
include(__DIR__ . '/../layout/header.php');
?>
<div class="timeline feed-list">
    <form class="well form-search w500" action="<?php echo SITE_BASE; ?>/search" method="post" onsubmit="$.blockUI();">
      <input type="hidden" name="quick" value="true"/>
      <div class="controls">
      <fieldset>
        <div class="field">
          <label for="field">工作领域:</label>
        <select id="field" name="field" style="width:110px;">
          <option value="">工作领域:</option>
<?php $i=1;while (Util::getFieldName($i) != $i ): ?>
<option value="<?php echo $i; ?>"> <?php echo Util::getFieldName($i++); ?> </option>
<?php endwhile; ?>
        </select>
      <select id="start_year" name="start_year" style="width:85px;">
          <option value="">入学年份</option>
          <?php for ($i = 1993; $i <= date('Y'); $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
        </div>
        <div class="field">
       <label for="major">专业：</label>
        <input name="major" type="text" maxlength="140" placeholder="在校专业" style="width:100px;"/>
        <label for="location">地区：</label>
        <input name="location" type="text" maxlength="140" placeholder="现工作地区" style="width:100px;"/>
</div>
        <div class="field">
        <label for="words">用户名：</label>
        <input name="words" type="text" class="input-xlarge span4" maxlength="140" placeholder="搜索用户、人名"/>
</div>
      </fieldset>
        <button type="submit" class="btn btn-danger btn-large">找人</button>
      </div>
    </form>
<?php if ($this->editable): ?>
    <form class="well form-search w500" id="sendmail-form" method="post" >

      <div class="failure" style="display:none"></div>
<!-- <a class="btn btn-primary" href="#"><font color="#FFF">给下列用户群发邮件</font></a> -->
<input id="field" name="field" type="hidden" value="<?php echo $this->field; ?>">
<input id="start_year" name="start_year" type="hidden" value="<?php echo $this->start_year; ?>">
<input id="major" name="major" type="hidden" value="<?php echo $this->major; ?>">
<input id="location" name="location" type="hidden" value="<?php echo $this->location; ?>">
<input id="words" name="words" type="hidden" value="<?php echo $this->words; ?>">
<label for="mail-title">标题</label>
<input id="mail-title" name="mail-title" class="input-xlarge"  placeholder="邮件标题"/>

<br/>
<label for="mail-content">正文:</label>
<br/>
<textarea id="mail-content" name="mail-content" class="input-xlarge"  rows="10" placeholder="正文">
</textarea>
<br/>
        <button type="submit" class="btn btn-danger btn-large">给下列用户群发邮件</button>
<br/>
<div class="progress progress-striped active" style="display:none">
  <div class="bar" style="width: 0%;"></div>
</div>

</form>
<?php endif; ?>
<?php if (isset($this->users)): ?>
<?php foreach ($this->users as $profile): ?>
  <?php
    $username = $profile->getLoginName();
    $avatarfile = AVATAR_DIR . $username . '-mini.jpg';
    $isAllowed=$this->editable||UserHelper::viewProfile($profile);
  ?>
  <article class="a-feed" id="user-<?php echo $profile->getId(); ?>">
    <aside>
      <figure>
<?php if ($isAllowed): ?>
        <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>">
<?php endif; ?>
          <?php if (file_exists($avatarfile)): ?>
            <img src="<?php echo AVATAR_BASE; ?>/<?php echo $username; ?>-mini.jpg" width="40px" height="40px"/>
          <?php else: ?>
            <img src="<?php echo SITE_BASE; ?>/images/avatar-40.jpg" width="40px" height="40px"/>
          <?php endif; ?>

<?php if ($isAllowed): ?>
        </a>
<?php endif; ?>
      </figure>
    </aside>
    <h3>
<?php if ($isAllowed): ?>
      <a href="<?php echo SITE_BASE; ?>/profile/<?php echo $profile->getId(); ?>">
<?php endif; ?>
<?php echo htmlspecialchars($profile->getDisplayName()); ?>
<?php if ($isAllowed): ?>
</a>
<?php endif; ?>
      <span>:</span>
	      <span><?php echo "领域:".Util::getFieldName($profile->getField()).";  单位:".$profile->getInstitute().";  职务:".$profile->getPosition();?>  </span>
    </h3>
    <div class="details">
      <div class="legend">
        <span >现居住地:</span>
	<span>  <?php echo $profile->getLocation(); ?></span>
      </div>
    </div>
  </article>
<?php endforeach; ?>
<?php endif; ?>
</div>
<?php
if($this->editable)$javascripts = array('jquery-1.7.1.min', 'jquery.blockui.min', 'bootstrap.min', 'hide-broken-images','json','admin/sendmail');
else $javascripts = array('jquery-1.7.1.min', 'jquery.blockui.min', 'bootstrap.min', 'hide-broken-images');
include(__DIR__ . '/../layout/footer.php');
