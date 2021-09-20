//loding画面

// function loaded() {
//   document.getElementById("loading").classList.remove("active");
// }

// window.addEventListener("load", function(){
//   setTimeout(loaded, 1000)
// })

// 重たくなって遅くなっても5秒で切れる設定
// setTimeout(loaded, 5000)

//mainページのふわっ
const targetElement = document.querySelectorAll(".animationTarget");
console.log("画面の高さ", window.innerHeight)
document.addEventListener("scroll", function(){
  //画面の位置bがん上からの距離を出す
  for (let i = 0; i < targetElement.length; i++) {
    const getElementDistance = targetElement[i].getBoundingClientRect().top + targetElement[i].clientHeight * .6
    if (window.innerHeight > getElementDistance) {
      targetElement[i].classList.add("show");
    }
  }
})