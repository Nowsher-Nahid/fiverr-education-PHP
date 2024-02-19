<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<!-- datatable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- sweet alert  -->
<script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>

<script>
    let table = new DataTable('#example');
</script>

<script src="assets/js/step.js"></script>
<?php 
$filename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
if($filename == 'planning-tools.php'){
?>
<?php $currentDateTime = date("Y-m-dH:i:s"); ?>
<script src="assets/js/teacher.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/strength.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/difficulty.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/support.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/area.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/student.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/goal.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/action.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/task-asignment.js?version=<?php echo $currentDateTime ?>"></script>
<script src="assets/js/report.js?version=<?php echo $currentDateTime ?>"></script>
<?php } ?>

</body>
</html>