<!-- Contact Section Start -->
<?php
  include ('part/header.php');
?>

<section id="contact" class="contact">
      <h2><span>Kontak</span> Kami</h2>
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis placeat
        at aut ipsa vel commodi voluptas dolorum qui corrupti quidem!
      </p>
      <div class="row">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126715.84305013811!2d110.33466310515672!3d-7.024552225281582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4d3f0d024d%3A0x1e0432b9da5cb9f2!2sKota%20Semarang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1691123762640!5m2!1sid!2sid"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="maps"
        ></iframe>

        <form action="">
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" placeholder="Nama" />
          </div>
          <div class="input-group">
            <i data-feather="mail"></i>
            <input type="text" placeholder="email" />
          </div>
          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" placeholder="nomor hp" />
          </div>
          <div class="input-group">
            <input type="text-area" placeholder="Masukan Kritik dan saran" />
          </div>
          <button type="submit" class="btn">kirim pesan</button>
        </form>
      </div>
    </section>
    <!-- Contact Section End -->

    <?php
      include ('part/footer.php');
    ?>