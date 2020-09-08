"use strict"

const DIRT_TEXTURES = {
  "top": [
    "/img/textures/2d/dirt-top-1.png",
    "/img/textures/2d/dirt-top-2.png",
    "/img/textures/2d/dirt-top-3.png"
  ],
  "side": [
    "/img/textures/2d/dirt-side-1.png",
    "/img/textures/2d/dirt-side-2.png",
    "/img/textures/2d/dirt-side-3.png",
    "/img/textures/2d/dirt-side-4.png",
    "/img/textures/2d/dirt-side-5.png"
  ]
};

class Dirt extends Block {
  createTexture(type) {
    if (type === "top" || type === "bottom") {
      const texture = DIRT_TEXTURES.top.random();

      return `url(${texture})`;
    }

    const texture = DIRT_TEXTURES.side.random();

    return `url(${texture})`;
  }
}

Block.Dirt = Dirt;
