<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<!-- datatable -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- sweet alert  -->
<script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>
<!-- script js -->
<script src="assets/js/step.js"></script>

<?php 
$filename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
if($filename == 'planning-tools.php'){
?>
<script src="assets/js/teacher.js"></script>
<script src="assets/js/area.js"></script>
<script src="assets/js/student.js"></script>
<script src="assets/js/goal.js"></script>
<script src="assets/js/action.js"></script>
<script src="assets/js/task-asignment.js"></script>
<script src="assets/js/report.js"></script>
<?php } ?>

</body>
</html>