function sendData()
{
    var name = document.getElementById("name").value;
    var age = document.getElementById("age").value; 

    console.log(name);
    console.log(age);

    $.ajax({
        type: 'post',
        url: 'test.php',
        data: {
          name:name,
          age:age
        },
        success: function (response) {
          $('#res').html("Your data will be saved...");
        }
      });

    return false;

}