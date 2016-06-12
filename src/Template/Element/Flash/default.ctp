<?php
$class = 'alert alert-dismissible';
if (!empty($params['class'])) {
    if($params['class']=='error') {
      $class .= ' ' . 'alert-danger';
    } else {
      $class .= ' ' . $params['class'];
    }
}
?>
<div class="<?= h($class) ?>" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
        <span class="sr-only">Close</span>
    </button>

    <?= h($message) ?>
</div>
