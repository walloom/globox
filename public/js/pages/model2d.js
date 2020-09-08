
Number.prototype.toInt = String.prototype.toInt = function() {
  return parseInt(this, 10);
};

Array.prototype.random = function() {
  return this[Math.floor(Math.random() * this.length)];
};

let first = new Block.Dirt(1, 1, 1);

const $scene = $(".scene");
const $body = $("body");

for (let x = 0; x < 6; x++) {
  for (let y = 0; y < 6; y++) {
    let next = new Block.Dirt(x, y, 0);
    next.block.appendTo($scene);
  }
}

function createCoordinatesFrom(side, x, y, z) {
  if (side == "top") {
    z += 1;
  }

  if (side == "side-1") {
    y += 1;
  }

  if (side == "side-2") {
    x += 1;
  }

  if (side == "side-3") {
    y -= 1;
  }

  if (side == "side-4") {
    x -= 1;
  }

  if (side == "bottom") {
    z -= 1;
  }

  return [x, y, z];
}

$body.on("click", ".side", function(e) {
  const $this = $(this);
  const previous = $this.data("block");

  if ($body.hasClass("subtraction")) {
    previous.block.remove();
    previous = null;
  } else {
    const coordinates = createCoordinatesFrom(
      $this.data("type"),
      previous.x,
      previous.y,
      previous.z
    );

    const next = new Block.Dirt(...coordinates);

    next.block.appendTo($scene);
  }
});

let ghost = null;

function removeGhost() {
  if (ghost) {
    ghost.block.remove();
    ghost = null;
  }
}

function createGhostAt(x, y, z) {
  const next = new Block.Dirt(x, y, z);

  next.block
    .addClass("ghost")
    .appendTo($scene);

  ghost = next;
}

$body.on("mouseenter", ".side", function(e) {
  removeGhost();

  const $this = jQuery(this);
  const previous = $this.data("block");

  const coordinates = createCoordinatesFrom(
    $this.data("type"),
    previous.x,
    previous.y,
    previous.z
  );

  createGhostAt(...coordinates);
});

$body.on("mouseleave", ".side", function(e) {
  removeGhost()
});

let lastMouseX = null;
let lastMouseY = null;

let sceneTransformX = 60;
let sceneTransformY = 0;
let sceneTransformZ = 60;
let sceneTransformScale = 1;

$body.on("mousewheel", function(event) {
  if (event.originalEvent.deltaY > 0) {
    sceneTransformScale -= 0.05;
  } else {
    sceneTransformScale += 0.05;
  }

  changeViewport();
});

$scene.on("mousedown", function(e) {
  e.stopPropagation();
});

$body.on("mousedown", function(e) {
  lastMouseX = e.clientX / 10;
  lastMouseY = e.clientY / 10;
});

$body.on("mousemove", function(e) {
  if (!lastMouseX) {
    return;
  }

  let nextMouseX = e.clientX / 10;
  let nextMouseY = e.clientY / 10;

  if (nextMouseX !== lastMouseX) {
    let deltaX = nextMouseX.toInt() - lastMouseX.toInt();
    degrees = sceneTransformZ - deltaX;

    if (degrees > 360) {
        degrees -= 360;
    }

    if (degrees < 0) {
        degrees += 360;
    }

    sceneTransformZ = degrees;
    lastMouseX = nextMouseX;

    changeViewport();
  }

  if (nextMouseY !== lastMouseY) {
    let deltaY = nextMouseY.toInt() - lastMouseY.toInt();
    degrees = sceneTransformX - deltaY;

    if (degrees > 360) {
        degrees -= 360;
    }

    if (degrees < 0) {
        degrees += 360;
    }

    sceneTransformX = degrees;
    lastMouseY = nextMouseY;

    changeViewport();
  }
});

$body.on("mouseup", function(e) {
  lastMouseX = null;
  lastMouseY = null;
});

function changeViewport() {
  $scene.css({
    "transform": `
      rotateX(${sceneTransformX}deg)
      rotateY(${sceneTransformY}deg)
      rotateZ(${sceneTransformZ}deg)
      scaleX(${sceneTransformScale})
      scaleY(${sceneTransformScale})
      scaleZ(${sceneTransformScale})
    `
  });
};

$body.on("keydown", function(e) {
  if (e.altKey) {
    $body.addClass("subtraction");
  }
});

$body.on("keyup", function(e) {
  $body.removeClass("subtraction");
});
