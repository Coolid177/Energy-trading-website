<?= $this->section("title") ?>
statistics
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<?= $this->include("templates/profilenavigation") ?>
<div class="container mb-4 mt-4 d-flex flex-column pb-1">
  <canvas class="mb-4 pb-4" id="productSolds"></canvas>
  <canvas class="mb-4 pb-4" id="productRevenue"></canvas>
  <canvas class="mb-4 pb-4" id="productVisits"></canvas>
</div>
<?= $this->endsection() ?>
<?= $this->section("javascript") ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
<script src="/statistics.js"></script>
<?= $this->endsection() ?>