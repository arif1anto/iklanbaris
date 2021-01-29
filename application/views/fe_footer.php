
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <h6 class="heading-footer">ABOUT US</h6>
          <p><?= getconfig('about') ?></p>
          <p><i class="fa fa-phone"></i> <span>Call Us :</span> <?= getconfig('telp') ?></p>
          <p><i class="fa fa-envelope"></i> <span>Send Email :</span> <?= getconfig('email') ?></p>
        </div>
        <div class="col-lg-2 col-md-4 social-icons">
          <h6 class="heading-footer">FOLLOW</h6>
          <ul class="footer-ul">
            <li><a href="<?= getconfig('fb') ?>"><i class=" fa fa-facebook"></i> Facebook</a></li>
            <li><a href="<?= getconfig('twitter') ?>"><i class=" fa fa-twitter"></i> Twitter</a></li>
            <li><a href="<?= getconfig('gplus') ?>"><i class=" fa fa-google-plus"></i> Google+</a></li>
            <li><a href="<?= getconfig('linkedin') ?>"><i class=" fa fa-linkedin"></i> Linkedin</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
        </div>
      </div>
    </div>
  </footer>
  <!--footer start from here-->

  <div class="copyright">
    <div class="container">
      <div class="col-lg-6 col-md-4">
        <p>Project arif1anto version <?= getconfig('versi') ?></a>
        </p>
      </div>
      <div class="col-lg-6 col-md-8">

      </div>
    </div>
  </div>

  <script src="<?= base_url() ?>assets/global/plugins/visitor/ovc/counter.js"></script>