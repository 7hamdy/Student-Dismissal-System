<?php
require './class/db.php';
require './class/model.php';
require './class/tables.php';
require './includes/core.php';

// Fetch data before any HTML output
$grade_name = grade::get_list();
$selected_grade = isset($_GET['grade']) && array_key_exists($_GET['grade'], $grade_name)
    ? $_GET['grade']
    : ($student['grade'] ?? '');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام الدرجات - اختيار الفصل</title>
    
    <!-- Include all CSS in head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css"> <!-- Your custom styles -->

    <?php require './includes/header.php'; ?>
</head>
<body class="bg-light">

<?php require './includes/nav.php'; ?>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0">اختيار الفصل الدراسي</h3>
                </div>
                <div class="card-body py-4">
                    <div class="form-group">
                        <label for="gradeSelect" class="form-label h5 mb-3">حدد الفصل من القائمة:</label>
                        <select id="gradeSelect" class="form-select select2-enhanced" style="width: 100%;">
                            <option value="">-- الرجاء الاختيار --</option>
                            <?php foreach ($grade_name as $sid => $grade): ?>
                                <option value="<?= $sid ?>" <?= $sid == $selected_grade ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($grade) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="loadingOverlay" class="position-fixed top-0 start-0 w-100 h-100 d-none" style="background: rgba(255,255,255,0.8); z-index: 9999;">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">جار التحميل...</span>
        </div>
    </div>
</div>

<!-- Scripts at bottom -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php require './includes/footer.php'; ?>

<script>
$(document).ready(function() {
    // Initialize Select2 with better configuration
    $('#gradeSelect').select2({
        placeholder: "اختر الفصل",
        allowClear: true,
        width: 'resolve',
        dropdownParent: $('.card-body')
    });

    // Handle selection change
    $('#gradeSelect').on('change', function() {
        const gradeId = $(this).val();
        if (gradeId) {
            $('#loadingOverlay').removeClass('d-none');
            setTimeout(() => {
                window.location.href = `show_display.php?grade=${gradeId}`;
            }, 300);
        }
    });
});
</script>

</body>
</html>