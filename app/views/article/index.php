<?php
$title = '新闻';
$no_sidebar = true;
$stylesheets = array('jquery.fancybox-1.3.4', 'articles');
include(__DIR__ . '/../layout/header.php');
?>
<h1>
  <?php echo $title; ?>
  <?php if ($this->editable): ?>
    <a class="fancy-link" href="#new-article">
      <img src="<?php echo SITE_BASE; ?>/images/icons/page_add.png"/>
    </a>
  <?php endif; ?>
</h1>
<ul class="articles">
  <?php foreach ($this->articles as $article): ?>
    <li>
      <a class="fancy-link" href="#article-<?php echo $article->getId(); ?>">
        <?php echo $article->getTitle(); ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
<div style="display:none">
  <?php foreach ($this->articles as $article): ?>
    <article id="article-<?php echo $article->getId(); ?>" class="popup">
      <h1><?php echo $article->getTitle(); ?></h1>
      <section><?php echo $article->getContent(); ?></section>
    </article>
  <?php endforeach; ?>
  <div id="new-article">
    <h1>添加新闻</h1>
    <form id="new-article-form" method="POST">
      <div class="field">
        <label for="title">标题：</label>
        <input class="textfield monofont" type="text" id="title" name="title" maxlength="200"/>
      </div>
      <div class="field">
        <textarea class="monofont" name="content" rows="10" cols="80"></textarea>
      </div>
      <div class="failure" style="display:none"></div>
      <div class="action">
        <button type="submit" class="classy primary" data-afterclick="正在提交⋯⋯">
          <span>提交</span>
        </button>
      </div>
      <p class="clear"></p>
    </form>
  </div>
</div>
<?php
$javascripts = array('jquery-1.7.1.min', 'jquery.fancybox-1.3.4.pack', 'jquery.easing-1.3.pack', 'jquery.mousewheel-3.0.4.pack', 'article/index');
include(__DIR__ . '/../layout/footer.php');
