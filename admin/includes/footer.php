  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- WYSIWYG -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="js/script.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',     <?php echo $session->count; ?>],
          ['Photos',      <?php echo Photo::countAll(); ?>],
          ['Users',  <?php echo User::countAll(); ?>],
          ['Comments', <?php echo Comment::countAll(); ?>]
        ]);

        var options = {
          legend: 'none',
          pieSliceText: 'label',
          title: 'My Daily Activities',
          backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
