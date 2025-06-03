<script>
document.addEventListener('DOMContentLoaded', function () {
    var userNameInput = document.getElementById('userName');
    var userInstitutionInput = document.getElementById('userInstitution');
    var btnSubmitIdentitas = document.getElementById('btnSubmitIdentitas');
    var evaluationForm = document.getElementById('evaluationForm');
    var userNameBadge = document.getElementById('userNameBadge');
    var formUserName = document.getElementById('formUserName');
    var formUserInstitution = document.getElementById('formUserInstitution');

    btnSubmitIdentitas.addEventListener('click', function () {
        var name = userNameInput.value.trim();
        if (!name) {
            alert('Nama lengkap harus diisi.');
            userNameInput.focus();
            return;
        }
        userNameBadge.textContent = name;
        formUserName.value = name;
        formUserInstitution.value = userInstitutionInput.value.trim();

        evaluationForm.style.display = 'block';
        btnSubmitIdentitas.disabled = true;
        userNameInput.disabled = true;
        userInstitutionInput.disabled = true;
    });

    // Tooltip bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Chart.js untuk grafik
    @if(session('hasil'))
    const ctx = document.getElementById('rankingChart').getContext('2d');
    const dataLabels = @json(array_column(session('hasil'), 'nama'));
    const dataScores = @json(array_map(fn($r) => $r['skor'], session('hasil')));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataLabels,
            datasets: [{
                label: 'Skor Alternatif',
                data: dataScores,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    @endif
});
</script>
