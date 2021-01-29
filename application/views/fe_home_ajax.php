
<div class="container">
  <div class="row">
    <?php
foreach ($iklan_data as $row)
{
    ?>
    <div class="col-md-3">
      <div class="iklan-container <?= $row->container_class ?>">
        <div class="iklan-title <?= $row->title_class ?>"><h5><?= $row->ads_title ?></h5></div>
        <div class="iklan-body"><?= $row->ads_konten ?></div>
        <div class="iklan-foot">
          <p class="pull-right">#<?= $row->ads_id ?></p>
        </div>
      </div>
    </div>
    <?php
}
?>
  <!--   <div class="col-md-3">
      <div class="iklan-container">
        <div class="iklan-title with-border with-bg-black"><h5>JUDUL</h5></div>
        <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
        <div class="iklan-foot">
          <p class="pull-right">#878471</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="iklan-container border-red">
        <div class="iklan-title with-border with-bg-red"><h5>JUDUL</h5></div>
        <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
        <div class="iklan-foot">
          <p class="pull-right">#878471</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="iklan-container font-color-blue">
        <div class="iklan-title with-border"><h5>JUDUL</h5></div>
        <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
        <div class="iklan-foot">
          <p class="pull-right">#878471</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="iklan-container">
        <div class="iklan-title with-border"><h5>JUDUL</h5></div>
        <div class="iklan-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
        <div class="iklan-foot">
          <p class="pull-right">#878471</p>
        </div>
      </div>
    </div> -->
  </div>
</div>
<div class="col-md-10 offset-md-1">
  <center>
  <?php echo $pagination ?>
  </center>
</div>
