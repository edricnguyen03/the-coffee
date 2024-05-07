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
  for (const x of data) {
    provinces.options[provinces.options.length] = new Option(x.Name, x.Id);
  }

  provinces.onchange = function () {
    district.length = 1;
    ward.length = 1;
    if (this.value != "") {
      const result = data.filter((n) => n.Id === this.value);

      for (const k of result[0].Districts) {
        districts.options[districts.options.length] = new Option(k.Name, k.Id);
      }
    }
  };

  district.onchange = function () {
    ward.length = 1;
    const dataProvince = data.filter((n) => n.Id === provinces.value);
    if (this.value != "") {
      const dataWards = dataProvince[0].Districts.filter(
        (n) => n.Id === this.value
      )[0].Wards;

      for (const w of dataWards) {
        wards.options[wards.options.length] = new Option(w.Name, w.Id);
      }
    }
  };
}
