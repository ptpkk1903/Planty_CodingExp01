// Event
function send_event(form){
    document.getElementById("event-btn").style.display = "none";
    var form_data = new FormData();
    form_data.append("cmm", "add-event");
    form_data.append("day", document.getElementById('day-select').value);
    form_data.append("event", document.getElementById('topic_name').value);
    form_data.append("start_time", document.getElementById('time_start').value);
    form_data.append("end_time", document.getElementById('time_end').value);
    $.ajax({
        url: 'add',
        data: form_data,
        datatype: 'json',
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            console.log(data);
            let result = data.indexOf("9001");
            if (result != "-1") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Successful!',
                    showConfirmButton: true,
                    timer: 1500
                  }).then((msg) => {
                    //Successful
                    window.location.href = "infomation";
                  })
            } else {
                let result_info = data.indexOf("9002");
                if (result_info != "-1") {
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Have Problem!',
                        showConfirmButton: true,
                        timer: 1500
                      }).then((msg) => {
                        //Info
                        document.getElementById("event-btn").style.display = "block";
                      })
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error!!',
                        showConfirmButton: true,
                        timer: 1500
                      }).then((msg) => {
                        //error
                        window.location.href = "infomation";
                      })
                }
            }
        },
        error: function(data) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Server Down!!',
                showConfirmButton: true,
                timer: 1500
              }).then((msg) => {
                window.location.href = "logout";
              })
        }
    });
}


// Status
function send_status(form){
  document.getElementById("status-btn").style.display = "none";
  var form_data = new FormData();
  form_data.append("cmm", "add-status");
  form_data.append("status", document.getElementById('status_name').value);
  form_data.append("color", document.getElementById('color').value);
  form_data.append("hidden", document.getElementById('hidden-select').value);
  $.ajax({
      url: 'add',
      data: form_data,
      datatype: 'json',
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
          console.log(data);
          let result = data.indexOf("9001");
          if (result != "-1") {
              Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Successful!',
                  showConfirmButton: true,
                  timer: 1500
                }).then((msg) => {
                  //Successful
                  window.location.href = "infomation";
                })
          } else {
              let result_info = data.indexOf("9002");
              if (result_info != "-1") {
                  Swal.fire({
                      position: 'center',
                      icon: 'info',
                      title: 'Have Problem!',
                      showConfirmButton: true,
                      timer: 1500
                    }).then((msg) => {
                      //Info
                      document.getElementById("status-btn").style.display = "block";
                    })
              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Error!!',
                      showConfirmButton: true,
                      timer: 1500
                    }).then((msg) => {
                      //error
                      window.location.href = "infomation";
                    })
              }
          }
      },
      error: function(data) {
          Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Server Down!!',
              showConfirmButton: true,
              timer: 1500
            }).then((msg) => {
              window.location.href = "logout";
            })
      }
  });
}


// Topic
function send_topic(form){
  document.getElementById("topic-btn").style.display = "none";
  var form_data = new FormData();
  form_data.append("cmm", "add-topic");
  form_data.append("topic", document.getElementById('topic_work_name').value);
  form_data.append("commander", document.getElementById('commander_name').value);
  $.ajax({
      url: 'add',
      data: form_data,
      datatype: 'json',
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
          console.log(data);
          let result = data.indexOf("9001");
          if (result != "-1") {
              Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Successful!',
                  showConfirmButton: true,
                  timer: 1500
                }).then((msg) => {
                  //Successful
                  window.location.href = "infomation";
                })
          } else {
              let result_info = data.indexOf("9002");
              if (result_info != "-1") {
                  Swal.fire({
                      position: 'center',
                      icon: 'info',
                      title: 'Have Problem!',
                      showConfirmButton: true,
                      timer: 1500
                    }).then((msg) => {
                      //Info
                      document.getElementById("topic-btn").style.display = "block";
                    })
              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Error!!',
                      showConfirmButton: true,
                      timer: 1500
                    }).then((msg) => {
                      //error
                      window.location.href = "infomation";
                    })
              }
          }
      },
      error: function(data) {
          Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Server Down!!',
              showConfirmButton: true,
              timer: 1500
            }).then((msg) => {
              window.location.href = "logout";
            })
      }
  });
}

function getSelectedRadioValue() {
  // เลือก radio button ที่ถูกเลือก
  var selectedRadio = document.querySelector('input[name="Status_select"]:checked');

  // ดึงค่า value จาก radio button ที่ถูกเลือก
  if (selectedRadio) {
    var selectedValue = selectedRadio.value;
    console.log('Selected value:', selectedValue);
    return selectedValue; // ให้ฟังก์ชัน return ค่า value ที่ถูกเลือก
  } else {
    console.log('No radio button selected.');
    return "";
  }
}

// Work
function send_work(form){
  document.getElementById("hw-btn").style.display = "none";
  var form_data = new FormData();
  form_data.append("cmm", "add-work");
  form_data.append("topic_id", document.getElementById('topic-select').value);
  form_data.append("work_name", document.getElementById('work_name').value);
  form_data.append("work_infomation", document.getElementById('work_infomation').value);
  form_data.append("work_deadline", document.getElementById('work_deadline').value);
  form_data.append("difficult", document.getElementById('difficult-select').value);
  form_data.append("status_data", getSelectedRadioValue());
  $.ajax({
      url: 'add',
      data: form_data,
      datatype: 'json',
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data) {
          console.log(data);
          let result = data.indexOf("9001");
          if (result != "-1") {
              Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Successful!',
                  showConfirmButton: true,
                  timer: 1500
                }).then((msg) => {
                  //Successful
                  window.location.href = "work_list";
                })
          } else {
              let result_info = data.indexOf("9002");
              if (result_info != "-1") {
                  Swal.fire({
                      position: 'center',
                      icon: 'info',
                      title: 'Have Problem!',
                      showConfirmButton: true,
                      timer: 1500
                    }).then((msg) => {
                      //Info
                      document.getElementById("hw-btn").style.display = "block";
                    })
              } else {
                  Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Error!!',
                      showConfirmButton: true,
                      timer: 1500
                    }).then((msg) => {
                      //error
                      window.location.href = "work_list";
                    })
              }
          }
      },
      error: function(data) {
          Swal.fire({
              position: 'center',
              icon: 'error',
              title: 'Server Down!!',
              showConfirmButton: true,
              timer: 1500
            }).then((msg) => {
              window.location.href = "logout";
            })
      }
  });
}