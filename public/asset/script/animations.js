const words = ["Plaquistes","Electriciennes",
"Plombières","Menuisières"];

let masterTL = gsap.timeline({repeat: -1});

words.forEach(word => {
    let tl = gsap.timeline({
    repeat : 1, yoyo:true})
    tl.to('.text',{duration: 1, text: word})
    masterTL.add(tl)} );





