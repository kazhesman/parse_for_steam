const btnCreate = document.getElementById("btncreate");
const btnsettings = document.getElementById('togglesettings');
const btnopensclose = document.getElementById('toggle');

// function createList() {
//     let createnewlist = document.querySelector("#createnewlist");

// }


// btncreate.addEventListener('click', createList);

// let list = document.getElementById('list');
// console.log(document.getElementById("btncreate"));
// document.getElementById("btncreate").addEventListener("click", () => {
//     const original = document.getElementById("list");
//     const clone = original.cloneNode(true); // true - копировать вложенные элементы
//     // document.body.appendChild(clone); // Добавляем копию в конец body
//     list.after(clone);
//   });


// let rotated = false;
// document.querySelectorAll(".icons").forEach(icon => {
//     icon.addEventListener("click", function() {
//       rotated = !rotated;
//       this.style.transform = `scaleX(-1) rotate(${rotated ? -90 : 0}deg)`;
//       this.style.transition = "transform 0.3s ease-in-out";
//     });
//   });
function getCoords(elem) {
  let box = elem.getBoundingClientRect();
  return {
      top: box.top + window.scrollY,
      left: box.left + window.scrollX
  };
}



btnCreate.addEventListener("click", () => {
            const original = document.getElementById("listname");
            const gray = document.getElementById("createnewlist");
            gray.style.left = "40px";
            const clone = original.cloneNode(true); // Копируем элемент со всем содержимым
            clone.removeAttribute("id"); // Убираем дублирующийся id
            clone.className = "new";
            
            // original.after(clone);
            setTimeout(() => {
                clone.classList.add("visible");
                gray.style.left = "10px";
              }, 100);
 })

// Получаем блок сообщения
const message = document.getElementById('settings');

// Добавляем обработчик клика на сообщение
message.addEventListener('click', function(event) {
    // Получаем позицию курсора
    const menu = document.getElementById('createnewlist');
    const xPods = [menu.clientHeight, menu.clientLeft, menu.clientTop, menu.clientWidth];   
    const xPos = event.clientX;
    const yPos = event.clientY;
    console.log(xPods, xPos,yPos);
    

    // Позиционируем меню рядом с курсором
    menu.style.left = xPos + 'px';
    menu.style.top = yPos + 'px';

    // Переключаем видимость меню
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
});


btnopensclose.addEventListener('click', function(event) {
  // Получаем позицию курсора
  // const menu = document.getElementById('createnewlist');
  // const xPods = [menu.clientHeight, menu.clientLeft, menu.clientTop, menu.clientWidth];   
  // const xPos = event.clientX;
  // const yPos = event.clientY;
  // console.log(xPods, xPos,yPos);
  

  // Позиционируем меню рядом с курсором
  // menu.style.left = xPos + 'px';
  // menu.style.top = yPos + 'px';

  // Переключаем видимость меню
  // menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
  // original.after(clone);
  //           setTimeout(() => {
  //               clone.classList.add("visible");
  //             }, 10);
const element = document.getElementById("listname");
const list = document.getElementById("results");
const coords = getCoords(element);
console.log("Абсолютные координаты:", coords);
list.style.position = 'absolute';
list.style.left = coords.left + 'px';
list.style.top = coords.top + 38 + 'px';

if(list.style.display == 'none') {
  
  let time = 25;
  let drr = 1;
  for (let i = 0; i < 4; ++i) {
    drr = i + '00px';
    setTimeout(() => {
      list.style.height = i + '00px'; // calback сделать
      list.style.display = 'inline';
    }, time);
    time+=25;
  }        
}
else {
  for (let i = 4; i < -4; --i) {
    
    setTimeout(() => {
      list.className = "new" + i;
    }, 100);

  }   
  list.style.display = 'none';
}

});


// Закрытие меню при клике вне меню
// document.addEventListener('click', function(event) {
//     const menu = document.querySelector('.dropdown-menu');
//     const message = document.querySelector('.message');

//     // Закрываем меню, если клик не был по сообщению или меню
//     if (!menu.contains(event.target) && event.target !== message) {
//         menu.style.display = 'none';
//     }
// });


// localstorage

// document.getElementById("clear").addEventListener("click", () => {
//     localStorage.removeItem("savedLists");
//     location.reload();
//   });

//   document.addEventListener("DOMContentLoaded", () => {
//     const container = document.body;
//     const btnCreate = document.getElementById("btncreate");

//     // Загружаем сохраненные списки
//     loadLists();

//     btnCreate.addEventListener("click", () => {
//         const original = document.getElementById("listname");
//         const clone = original.cloneNode(true); // Копируем элемент со всем содержимым
//         clone.removeAttribute("id"); // Убираем дублирующийся id
//         original.after(clone);


//         saveLists(); // Сохраняем списки в localStorage
//     });

//     function saveLists() {
//         localStorage.setItem("savedLists", container.innerHTML);
//     }

//     function loadLists() {
//         const saved = localStorage.getItem("savedLists");
//         if (saved) {
//             container.innerHTML = saved;
//         }
//     }
// });

// document.getElementById("createnewlist").addEventListener("click", (event) => {
//     if (event.target.classList.contains("icons")) {
//         console.log("1");
//     }
// });

