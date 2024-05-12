var provinces = document.getElementById("province");
var districts = document.getElementById("district");
var wards = document.getElementById("ward");
var Parameter = {
  url: "./resources/js/vietnam.json",
  method: "GET",
  responseType: "application/json",
};
//gọi ajax = axios => nó trả về cho chúng ta là một promise
var promise = axios(Parameter);
//Xử lý khi request thành công
promise.then(function (result) {
  renderProvince(result.data);
});

function renderProvince(data) {
  //Thêm option vào select provinces
  for (const x of data) {
    provinces.options[provinces.options.length] = new Option(x.Name, x.Id);
  }
  //Xử lý khi select provinces thay đổi
  provinces.onchange = function () {
    district.length = 1;
    ward.length = 1;
    if (this.value != "") {
      //lọc ra province tương ứng với Id được chọn
      const result = data.filter((n) => n.Id === this.value);

      //tạo ra các option cho districts tương ứng với province
      for (const k of result[0].Districts) {
        districts.options[districts.options.length] = new Option(k.Name, k.Id);
      }

      //lấy ra tên của province đã chọn
      var selectedProvinceName = this.options[this.selectedIndex].text;
      document.getElementById("province_name").value = selectedProvinceName;
    }
  };

  //Xử lý khi select districts thay đổi
  district.onchange = function () {
    ward.length = 1;
    //lọc ra province tương ứng với Id được chọn
    const dataProvince = data.filter((n) => n.Id === provinces.value);
    if (this.value != "") {
      //lọc ra district tương ứng với Id được chọn
      const dataWards = dataProvince[0].Districts.filter(
        (n) => n.Id === this.value
      )[0].Wards;

      //lấy ra tên của district đã chọn
      var selectedDistrictName = this.options[this.selectedIndex].text;
      document.getElementById("district_name").value = selectedDistrictName;

      //tạo ra các option cho wards tương ứng với district
      for (const w of dataWards) {
        wards.options[wards.options.length] = new Option(w.Name, w.Id);
      }
    }
  };

  //Xử lý khi select wards thay đổi
  ward.onchange = function () {
    if (this.value != "") {
      //lấy ra tên của ward đã chọn
      var selectedWardName = this.options[this.selectedIndex].text;
      document.getElementById("ward_name").value = selectedWardName;
    }
  };
}
