document.addEventListener("DOMContentLoaded", () => {
  document.body.style.opacity = 0;
  document.body.style.transition = "opacity .6s ease";
  setTimeout(()=> document.body.style.opacity = 1, 80);

  const nav = document.querySelector("header nav") || document.querySelector("nav");
  if (nav) {
    const t = document.createElement("button");
    t.className = "btn ghost";
    t.style.marginLeft = "10px";
    t.textContent = localStorage.getItem("theme")==="dark" ? "☀️" : "🌙";
    nav.appendChild(t);
    if (localStorage.getItem("theme")==="dark") document.body.classList.add("dark");
    t.addEventListener("click", ()=> {
      document.body.classList.toggle("dark");
      const isDark = document.body.classList.contains("dark");
      localStorage.setItem("theme", isDark ? "dark" : "light");
      t.textContent = isDark ? "☀️" : "🌙";
    });
  }

  window.showToast = (msg) => {
    const el = document.createElement("div");
    el.className = "toast";
    el.textContent = msg;
    document.body.appendChild(el);
    setTimeout(()=> el.remove(), 3200);
  };

  document.querySelectorAll(".btn-delete").forEach(btn=>{
    btn.addEventListener("click", e=>{
      if(!confirm("Yakin ingin menghapus data ini?")) e.preventDefault();
    });
  });


  document.querySelectorAll("input[data-search]").forEach(input=>{
    input.addEventListener("input", (ev)=>{
      const q = ev.target.value.toLowerCase();
      const table = document.querySelector(ev.target.datasetTarget || input.getAttribute("data-target")) || document.querySelector("table");
      if(!table) return;
      table.querySelectorAll("tbody tr").forEach(row=>{
        row.style.display = row.textContent.toLowerCase().includes(q) ? "" : "none";
      });
    });
  });

  document.querySelectorAll("th.sortable").forEach(header=>{
    header.addEventListener("click", ()=>{
      const table = header.closest("table");
      const tbody = table.querySelector("tbody");
      const index = Array.from(header.parentNode.children).indexOf(header);
      const rows = Array.from(tbody.querySelectorAll("tr"));
      const asc = !header.classList.contains("asc");
      table.querySelectorAll("th").forEach(th=>th.classList.remove("asc","desc"));
      header.classList.toggle("asc", asc);
      header.classList.toggle("desc", !asc);
      rows.sort((a,b)=>{
        const A = a.children[index].textContent.trim().toLowerCase();
        const B = b.children[index].textContent.trim().toLowerCase();
        return asc ? A.localeCompare(B) : B.localeCompare(A);
      });
      rows.forEach(r=>tbody.appendChild(r));
    });
  });

  // BACKGROUND SLIDER
  const slides = document.querySelectorAll(".bg-slide");
  if (slides.length){
    let current = 0;
    let timer = setInterval(nextSlide, 3000);
    function show(i){
      slides.forEach((s,idx)=> s.classList.toggle("active", idx===i));
    }
    function nextSlide(){
      current = (current + 1) % slides.length; show(current);
    }
    function prevSlide(){
      current = (current - 1 + slides.length) % slides.length; show(current);
    }
    const left = document.querySelector(".hero .arrow.left");
    const right = document.querySelector(".hero .arrow.right");
    if (left) left.addEventListener("click", ()=>{ prevSlide(); reset(); });
    if (right) right.addEventListener("click", ()=>{ nextSlide(); reset(); });
    function reset(){ clearInterval(timer); timer = setInterval(nextSlide, 3000); }
    show(0);
    
    window._bgNext = nextSlide; window._bgPrev = prevSlide;
  }
});
