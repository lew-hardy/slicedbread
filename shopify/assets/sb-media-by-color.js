(function () {
 const normalize = (val) => (val || "").toString().trim().toLowerCase().replace(/\s+/g, "-");

 function getSelectedColor() {
  // 1) Dawn variant radios: find the fieldset whose legend includes "Color"
  const fieldsets = document.querySelectorAll("variant-radios fieldset");
  for (const fs of fieldsets) {
   const legend = fs.querySelector("legend");
   if (legend && legend.textContent.toLowerCase().includes("color")) {
    const checked = fs.querySelector('input[type="radio"]:checked');
    if (checked) return normalize(checked.value);
   }
  }

  // 2) Dawn variant selects
  const selects = document.querySelectorAll("variant-selects select");
  for (const sel of selects) {
   const label = sel.closest(".product-form__input")?.querySelector("label");
   if (label && label.textContent.toLowerCase().includes("color")) {
    return normalize(sel.value);
   }
  }

  // 3) Fallback: any checked radio whose name includes color
  const any = document.querySelector('input[type="radio"]:checked[name*="color" i]');
  return any ? normalize(any.value) : "";
 }

 function setActiveMedia(mediaId) {
  const gallery = document.querySelector("media-gallery");
  if (gallery && typeof gallery.setActiveMedia === "function") {
   gallery.setActiveMedia(mediaId, true);
  }
 }

 function filterMediaByColor(color) {
  const gallery = document.querySelector("media-gallery");
  if (!gallery) return;

  // Dawn IDs include section.id, so select by structure instead of fixed IDs
  const mediaItems = gallery.querySelectorAll("[data-media-id][data-sb-color]");
  const thumbs = gallery.querySelectorAll(".thumbnail-list__item[data-sb-color]");

  if (!mediaItems.length) {
   console.warn("[SB] No media items found. Check data-sb-color + data-media-id exist.");
   return;
  }

  let firstMatchId = null;
  let hasTaggedMatch = false;

  mediaItems.forEach((el) => {
   const tag = normalize(el.getAttribute("data-sb-color"));
   const isGlobal = !tag;
   const show = isGlobal || (color && tag === color);

   el.hidden = !show;
   el.style.display = show ? "" : "none";

   if (show && !isGlobal && !firstMatchId) {
    firstMatchId = el.getAttribute("data-media-id");
    hasTaggedMatch = true;
   }
  });

  // If chosen color has no tagged images, show everything
  if (color && !hasTaggedMatch) {
   mediaItems.forEach((el) => {
    el.hidden = false;
    el.style.display = "";
   });
   firstMatchId = mediaItems[0]?.getAttribute("data-media-id") || null;
  }

  thumbs.forEach((el) => {
   const tag = normalize(el.getAttribute("data-sb-color"));
   const isGlobal = !tag;
   const show = isGlobal || (color && tag === color);

   el.hidden = !show;
   el.style.display = show ? "" : "none";
  });

  if (firstMatchId) setActiveMedia(firstMatchId);
 }

 function run() {
  const color = getSelectedColor();
  filterMediaByColor(color);
 }

 // Run once on load
 document.addEventListener("DOMContentLoaded", run);

 // Run on any option change (covers radios + selects)
 document.addEventListener("change", (e) => {
  const t = e.target;
  if (!t) return;

  // Variant radios/selects changes
  if (t.closest("variant-radios") || t.closest("variant-selects")) {
   run();
  }
 });

 // Also run when Dawn updates variant (some versions dispatch this)
 document.addEventListener("variant:change", run);
 document.addEventListener("variantChange", run);
})();
