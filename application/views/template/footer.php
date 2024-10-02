<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>
        &copy; <?= date('Y') ?>
        Dibuat Dengan
      </span>
      <i class="fas fa-heart text-danger"></i>
      <a target="_blank" href="https://hira-express.com">PT. Hira Adya Naranata</a> Hak cipta di lindungi <div class="bullet"></div>
    </div>
  </div>
</footer>
</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script src="<?= base_url('public/') ?>vendor/jquery/jquery.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/datatables/jquery.dataTables.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/select2/select2-full.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?= base_url('public/') ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/format.js"></script>

<?php if ($this->session->userdata('user_role') == 'admin') { ?>
  <?php if ($this->uri->segment(1) == 'user') { ?>

    <script src="<?= base_url('public/') ?>js/pages/main/user.js"></script>

  <?php } ?>
<?php } ?>

<?php if ($this->uri->segment(1) == 'merk') { ?>

  <script src="<?= base_url('public/') ?>js/pages/main/merk.js"></script>

<?php } elseif ($this->uri->segment(1) == 'stok') { ?>

  <script src="<?= base_url('public/') ?>js/pages/main/stok/part/stok.js"></script>

<?php } elseif ($this->uri->segment(1) == 'toko') { ?>

  <script src="<?= base_url('public/') ?>js/pages/main/toko.js"></script>

<?php } elseif ($this->uri->segment(1) == 'truck') { ?>

  <script src="<?= base_url('public/') ?>js/pages/main/truck.js"></script>

<?php } elseif ($this->uri->segment(1) == 'ban') { ?>

  <script src="<?= base_url('public/') ?>js/pages/main/stok/ban/ban.js"></script>

<?php } elseif ($this->uri->segment(1) == 'percab' && $this->uri->segment(2) == '') { ?>

  <script src="<?= base_url('public/') ?>js/pages/notify-swal.js"></script>

  <script src="<?= base_url('public/') ?>js/pages/trans/percab/index.js"></script>

<?php } elseif ($this->uri->segment(1) == 'percab' && $this->uri->segment(2) == 'detailAll') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/percab/all.js"></script>

<?php } elseif ($this->uri->segment(1) == 'percab' && $this->uri->segment(2) == 'addData') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/percab/add.js"></script>

<?php } elseif ($this->uri->segment(1) == 'beli' && $this->uri->segment(2) == '') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/part/beli/index.js"></script>

<?php } elseif ($this->uri->segment(1) == 'beli' && $this->uri->segment(2) == 'addData') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/part/beli/add.js"></script>

<?php } elseif ($this->uri->segment(1) == 'beli' && $this->uri->segment(2) == 'detailAll') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/part/beli/all.js"></script>

<?php } elseif ($this->uri->segment(1) == 'pakai' && $this->uri->segment(2) == '') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/part/pakai/index.js"></script>

<?php } elseif ($this->uri->segment(1) == 'pakai' && $this->uri->segment(2) == 'detailAll') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/part/pakai/all.js"></script>

<?php } elseif ($this->uri->segment(1) == 'pakai' && $this->uri->segment(2) == 'addData') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/part/pakai/add.js"></script>

<?php } elseif ($this->uri->segment(1) == 'oper' && $this->uri->segment(2) == '') { ?>

  <script src="<?= base_url('public/') ?>js/pages/trans/part/oper/index.js"></script>

<?php } ?>

</body>

</html>