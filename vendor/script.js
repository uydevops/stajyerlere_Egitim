$(document).ready(function() {
  // DataTable initialization
  $('#example').DataTable();

  // Edit button click event
  $('.edit-btn').on('click', function() {
      // Burada düzenleme işlemlerini gerçekleştirebilirsiniz
      alert('Edit button clicked');
  });

  // Delete button click event
  $('.delete-btn').on('click', function() {
      // Burada silme işlemlerini gerçekleştirebilirsiniz
      alert('Delete button clicked');
  });
});

// Check all checkbox
$('#check-all').on('click', function() {
  if (this.checked) {
      $('.check-item').each(function() {
          this.checked = true;
      });
  } else {
      $('.check-item').each(function() {
          this.checked = false;
      });
  }
});