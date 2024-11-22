  <!-- /.content-wrapper -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#propinsi_id').change(function() {
        var prop = $('#propinsi_id').val();
        $.ajax({
          type: "POST",
          url: "proc.php",
          data: {
            jenis: 'kab',
            prop: prop
          },
          success: function(res) {
            $('#kabupaten_id').html('<option value="">Pilih Kota/Kab</option>' + res);
            $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>');
            $('#desa_id').html('<option value="">Pilih Desa</option>');
          }
        });
      });

      $('#kabupaten_id').change(function() {
        var kab = $('#kabupaten_id').val();
        $.ajax({
          type: "POST",
          url: "proc.php",
          data: {
            jenis: 'kec',
            kab: kab
          },
          success: function(res) {
            $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>' + res);
            $('#desa_id').html('<option value="">Pilih Desa</option>');
          }
        });
      });

      $('#kecamatan_id').change(function() {
        var kec = $('#kecamatan_id').val();
        $.ajax({
          type: "POST",
          url: "proc.php",
          data: {
            jenis: 'desa',
            kec: kec
          },
          success: function(res) {
            $('#desa_id').html('<option value="">Pilih Desa</option>' + res);
          }
        });
      });
    });

