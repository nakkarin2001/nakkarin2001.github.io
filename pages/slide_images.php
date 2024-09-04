<?php

$query = "SELECT id, image_path FROM images";
$stmt = $pdo->query($query);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


    <style>
   .slider {
    width: 90vw; 
    max-width: 1300px; 
    height: 100vh;
    margin: auto;
    position: relative;
    overflow: hidden;
    border: 2px solid #ccc; 
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    background: #fff; 
}

.slider .list {
    position: absolute;
    width: 100%; 
    height: 100%;
    left: 0;
    top: 0;
    display: flex;
    transition: transform 0.5s ease-in-out; 
}

.slider .item {
    flex: 0 0 100%; 
    height: 100%; 
}

.slider .list img {
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
}

.slider .buttons {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between; 
    transform: translateY(-50%);
    padding: 0 20px;
    box-sizing: border-box; 
}

.slider .buttons button {
    width: 40px; 
    height: 40px; 
    border-radius: 50%; 
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff; 
    border: none; 
    font-family: Arial, sans-serif; 
    font-weight: bold; 
    cursor: pointer; 
    transition: background-color 0.3s ease; 
}

.slider .buttons button:hover {
    background-color: rgba(0, 0, 0, 0.8); 
}

.slider .dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    display: flex;
}

.slider .dots li {
    list-style: none;
    width: 12px;
    height: 12px;
    background-color: rgba(255, 255, 255, 0.6);
    margin: 0 5px;
    border-radius: 50%;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.slider .dots li.active {
    background-color: #fff;
    transform: scale(1.5); 
}

@media screen and (max-width: 768px) {
    .slider {
        height: 50vh; 
    }

    .slider .buttons button {
        width: 35px;
        height: 35px;
    }

    .slider .dots li {
        width: 8px;
        height: 8px;
    }
}


    </style>

    <div class="slider">
        <div class="list">
            <?php foreach ($images as $image): ?>
                <div class="item">
                    <img src="admin\dashboard\uploads\<?php echo htmlspecialchars($image['image_path']); ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="buttons">
            <button id="prev">&lt;</button>
            <button id="next">&gt;</button>
        </div>
        <ul class="dots">
            <?php foreach ($images as $index => $image): ?>
                <li class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
   document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.slider');
    const list = slider.querySelector('.list');
    const items = slider.querySelectorAll('.item');
    const dots = slider.querySelectorAll('.dots li');
    const nextBtn = document.getElementById('next');
    const prevBtn = document.getElementById('prev');
    let active = 0;
    let itemWidth = slider.offsetWidth; 

    function updateSlider() {
        list.style.transform = `translateX(-${active * itemWidth}px)`;
        
        const lastActiveDot = document.querySelector('.slider .dots li.active');
        if (lastActiveDot) lastActiveDot.classList.remove('active');
        dots[active].classList.add('active');

        clearInterval(refreshInterval);
        refreshInterval = setInterval(() => nextBtn.click(), 3000);
    }

    nextBtn.onclick = function() {
        active = (active + 1) % items.length;
        updateSlider();
    }

    prevBtn.onclick = function() {
        active = (active - 1 + items.length) % items.length;
        updateSlider();
    }

    let refreshInterval = setInterval(() => nextBtn.click(), 3000);

    dots.forEach((li, key) => {
        li.addEventListener('click', () => {
            active = key;
            updateSlider();
        });
    });

    window.onresize = function() {
        itemWidth = slider.offsetWidth; 
        updateSlider();
    };

    updateSlider(); 
});


    </script>
