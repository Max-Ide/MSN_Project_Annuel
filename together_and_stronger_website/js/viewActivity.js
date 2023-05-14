function viewActivity(button) {
    const activityId = button.getAttribute("data-id");
    window.location.href = "activity_detail.php?id=" + activityId;
  }