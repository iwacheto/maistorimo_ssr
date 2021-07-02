<template>
  <div>
    <div v-if="project" class="listing-slider mfp-gallery-container margin-bottom-0">
      <a
        v-for="image in project.project_galleries"
        :key="image.id"
        :href="image.url"
        data-background-image="https://res.cloudinary.com/maistorimo/image/upload/v1563292176/gprusiyski/5c94de5a790121132237995d2df20fb6709.jpg"
        class="item mfp-gallery"
        title="Title 1"
      ></a>
    </div>
    <div class="container margin-top-30">
      <div class="row sticky-wrapper">
        <div class="col-lg-8 col-md-8 padding-right-30">
          <!-- Titlebar -->
          <div id="titlebar" class="listing-titlebar">
            <div class="listing-titlebar-title">
              <h2>
                Burger House
                <span class="listing-tag">Eat & Drink</span>
              </h2>
              <span>
                <a href="#listing-location" class="listing-address">
                  <i class="fa fa-map-marker"></i>
                  2726 Shinn Street, New York
                </a>
              </span>
              <div class="star-rating" data-rating="5">
                <div class="rating-counter">
                  <a href="#listing-reviews">(31 reviews)</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Listing Nav -->
          <div id="listing-nav" class="listing-nav-container">
            <ul class="listing-nav">
              <li>
                <a href="#listing-overview" class="active">Преглед</a>
              </li>
              <li>
                <a href="#listing-pricing-list">Цена</a>
              </li>
              <li>
                <a href="#listing-location">Местоположение</a>
              </li>
              <li>
                <a href="#listing-reviews">Отзиви</a>
              </li>
              <li>
                <a href="#add-review">Добави отзив</a>
              </li>
            </ul>
          </div>

          <!-- Overview -->
          <div id="listing-overview" class="listing-section">
            <!-- Description -->

            <p>
              Родната къща на Васил Левски се намира в западната част на Карлово. Тя е от ранния период на Възраждането. Строена е през 18 вek от Кунчо Иванов, дядото на Левски,
              а след това е обитaвана от двамата му сина Иван и Въльо Кунчеви.
            </p>

            <p>
              Родната къща на Васил Левски се намира в западната част на Карлово. Тя е от ранния период на Възраждането. Строена е през 18 вek от Кунчо Иванов, дядото на Левски,
              а след това е обитaвана от двамата му сина Иван и Въльо Кунчеви. Къщата е малка едноетажна сграда. Каменни стълби отвеждат в зимника, стая, иззидана почти в земята.
              Вляво от стълбището има килер без прозорец със сандък за брашно, нощви и други съдове. Вдясно е скривалището. Пред него, в стената, е вграден долап, на който
              с вътрешната стена е дървена вратичка, измазана с вар. В долапа се нареждали нагънати черги, за да се закрива вратичката на самото скривалище.
            </p>

            <!-- Listing Contacts -->
            <div class="listing-links-container">
              <ul class="listing-links contact-links">
                <li>
                  <a href="tel:12-345-678" class="listing-links">
                    <i class="fa fa-phone"></i> +12 345 6578
                  </a>
                </li>
                <li>
                  <a href="mailto:mail@example.com" class="listing-links">
                    <i class="fa fa-envelope-o"></i> mail@example.com
                  </a>
                </li>
                <li>
                  <a href="#" target="_blank" class="listing-links">
                    <i class="fa fa-link"></i> www.example.com
                  </a>
                </li>
              </ul>
              <div class="clearfix"></div>

              <ul class="listing-links">
                <li>
                  <a href="#" target="_blank" class="listing-links-fb">
                    <i class="fa fa-facebook-square"></i> Facebook
                  </a>
                </li>
                <li>
                  <a href="#" target="_blank" class="listing-links-yt">
                    <i class="fa fa-youtube-play"></i> YouTube
                  </a>
                </li>
                <li>
                  <a href="#" target="_blank" class="listing-links-ig">
                    <i class="fa fa-instagram"></i> Instagram
                  </a>
                </li>
                <!-- <li>
									<a href="#" target="_blank" class="listing-links-tt">
										<i class="fa fa-twitter"></i> Twitter
									</a>
                </li>-->
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>

            <!-- Amenities -->
            <h3 class="listing-desc-headline">Удобства</h3>
            <ul class="listing-features checkboxes margin-top-0">
              <li>Асансъор в къщата</li>
              <li>Приятно работно място</li>
              <li>Библиотека</li>
              <li>Безжичен интернет</li>
              <li>Безплатен паркинг в помещенията</li>
              <li>Безплатен паркинга на улицата</li>
            </ul>
          </div>

          <!-- Food Menu -->
          <div id="listing-pricing-list" class="listing-section">
            <h3 class="listing-desc-headline margin-top-70 margin-bottom-30">Цена</h3>

            <div class="show-more">
              <div class="pricing-list-container">
                <!-- Food List -->
                <h4>Burgers</h4>
                <ul>
                  <li>
                    <h5>Classic Burger</h5>
                    <p>Beef, salad, mayonnaise, spicey relish, cheese</p>
                    <span>$6</span>
                  </li>
                  <li>
                    <h5>Cheddar Burger</h5>
                    <p>Cheddar cheese, lettuce, tomato, onion, dill pickles</p>
                    <span>$6</span>
                  </li>
                  <li>
                    <h5>Veggie Burger</h5>
                    <p>Panko crumbed and fried, grilled peppers and mushroom</p>
                    <span>$6</span>
                  </li>
                  <li>
                    <h5>Chicken Burger</h5>
                    <p>Cheese, chicken fillet, avocado, bacon, tomatoes, basil</p>
                    <span>$6</span>
                  </li>
                </ul>

                <!-- Food List -->
                <h4>Drinks</h4>
                <ul>
                  <li>
                    <h5>Frozen Shake</h5>
                    <span>$4</span>
                  </li>
                  <li>
                    <h5>Orange Juice</h5>
                    <span>$4</span>
                  </li>
                  <li>
                    <h5>Beer</h5>
                    <span>$4</span>
                  </li>
                  <li>
                    <h5>Water</h5>
                    <span>Free</span>
                  </li>
                </ul>
              </div>
            </div>
            <a
              href="#"
              class="show-more-button"
              data-more-title="Show More"
              data-less-title="Show Less"
            >
              <i class="fa fa-angle-down"></i>
            </a>
          </div>
          <!-- Food Menu / End -->

          <!-- Location -->
          <div id="listing-location" class="listing-section">
            <h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Местоположение</h3>

            <div id="singleListingMap-container">
              <div
                id="singleListingMap"
                data-latitude="40.70437865245596"
                data-longitude="-73.98674011230469"
                data-map-icon="im im-icon-Hamburger"
              ></div>
              <a href="#" id="streetView">Гледка</a>
            </div>
          </div>

          <!-- Reviews -->
          <div id="listing-reviews" class="listing-section">
            <h3 class="listing-desc-headline margin-top-75 margin-bottom-20">
              Отзиви
              <span>(12)</span>
            </h3>

            <!-- Rating Overview -->
            <div class="rating-overview">
              <div class="rating-overview-box">
                <span class="rating-overview-box-total">4.2</span>
                <span class="rating-overview-box-percent">out of 5.0</span>
                <div class="star-rating" data-rating="5"></div>
              </div>

              <div class="rating-bars">
                <div class="rating-bars-item">
                  <span class="rating-bars-name">
                    Услуга
                    <i
                      class="tip"
                      data-tip-content="Quality of customer service and attitude to work with you"
                    ></i>
                  </span>
                  <span class="rating-bars-inner">
                    <span class="rating-bars-rating" data-rating="4.2">
                      <span class="rating-bars-rating-inner"></span>
                    </span>
                    <strong>4.2</strong>
                  </span>
                </div>
                <div class="rating-bars-item">
                  <span class="rating-bars-name">
                    Съотношение качество-цена
                    <i
                      class="tip"
                      data-tip-content="Overall experience received for the amount spent"
                    ></i>
                  </span>
                  <span class="rating-bars-inner">
                    <span class="rating-bars-rating" data-rating="4.8">
                      <span class="rating-bars-rating-inner"></span>
                    </span>
                    <strong>4.8</strong>
                  </span>
                </div>
                <div class="rating-bars-item">
                  <span class="rating-bars-name">
                    Местоположение
                    <i
                      class="tip"
                      data-tip-content="Visibility, commute or nearby parking spots"
                    ></i>
                  </span>
                  <span class="rating-bars-inner">
                    <span class="rating-bars-rating" data-rating="3.7">
                      <span class="rating-bars-rating-inner"></span>
                    </span>
                    <strong>3.7</strong>
                  </span>
                </div>
                <div class="rating-bars-item">
                  <span class="rating-bars-name">
                    Чистота
                    <i
                      class="tip"
                      data-tip-content="The physical condition of the business"
                    ></i>
                  </span>
                  <span class="rating-bars-inner">
                    <span class="rating-bars-rating" data-rating="4.0">
                      <span class="rating-bars-rating-inner"></span>
                    </span>
                    <strong>4.0</strong>
                  </span>
                </div>
              </div>
            </div>
            <!-- Rating Overview / End -->

            <div class="clearfix"></div>

            <!-- Reviews -->
            <section class="comments listing-reviews">
              <ul>
                <li>
                  <div class="avatar">
                    <img
                      src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70"
                      alt
                    />
                  </div>
                  <div class="comment-content">
                    <div class="arrow-comment"></div>
                    <div class="comment-by">
                      Kathy Brown
                      <i
                        class="tip"
                        data-tip-content="Person who left this review actually was a customer"
                      ></i>
                      <span class="date">June 2019</span>
                      <div class="star-rating" data-rating="5"></div>
                    </div>
                    <p>
                      Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere
                      tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque
                      non metus
                    </p>

                    <div class="review-images mfp-gallery-container">
                      <a href="images/review-image-01.jpg" class="mfp-gallery">
                        <img src="images/review-image-01.jpg" alt />
                      </a>
                    </div>
                    <a href="#" class="rate-review">
                      <i class="sl sl-icon-like"></i> Helpful Review
                      <span>12</span>
                    </a>
                  </div>
                </li>

                <li>
                  <div class="avatar">
                    <img
                      src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70"
                      alt
                    />
                  </div>
                  <div class="comment-content">
                    <div class="arrow-comment"></div>
                    <div class="comment-by">
                      John Doe
                      <span class="date">May 2019</span>
                      <div class="star-rating" data-rating="4"></div>
                    </div>
                    <p>
                      Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim.
                      Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc
                      tellus sollicitudin mauris.
                    </p>
                    <a href="#" class="rate-review">
                      <i class="sl sl-icon-like"></i> Helpful Review
                      <span>2</span>
                    </a>
                  </div>
                </li>

                <li>
                  <div class="avatar">
                    <img
                      src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70"
                      alt
                    />
                  </div>
                  <div class="comment-content">
                    <div class="arrow-comment"></div>
                    <div class="comment-by">
                      Kathy Brown
                      <span class="date">June 2019</span>
                      <div class="star-rating" data-rating="5"></div>
                    </div>
                    <p>
                      Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere
                      tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque
                      non metus
                    </p>

                    <div class="review-images mfp-gallery-container">
                      <a href="images/review-image-02.jpg" class="mfp-gallery">
                        <img src="images/review-image-02.jpg" alt />
                      </a>
                      <a href="images/review-image-03.jpg" class="mfp-gallery">
                        <img src="images/review-image-03.jpg" alt />
                      </a>
                    </div>
                    <a href="#" class="rate-review">
                      <i class="sl sl-icon-like"></i> Helpful Review
                      <span>4</span>
                    </a>
                  </div>
                </li>

                <li>
                  <div class="avatar">
                    <img
                      src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70"
                      alt
                    />
                  </div>
                  <div class="comment-content">
                    <div class="arrow-comment"></div>
                    <div class="comment-by">
                      John Doe
                      <span class="date">May 2019</span>
                      <div class="star-rating" data-rating="5"></div>
                    </div>
                    <p>
                      Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim.
                      Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc
                      tellus sollicitudin mauris.
                    </p>
                    <a href="#" class="rate-review">
                      <i class="sl sl-icon-like"></i> Helpful Review
                    </a>
                  </div>
                </li>
              </ul>
            </section>

            <!-- Pagination -->
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <!-- Pagination -->
                <div class="pagination-container margin-top-30">
                  <nav class="pagination">
                    <ul>
                      <li>
                        <a href="#" class="current-page">1</a>
                      </li>
                      <li>
                        <a href="#">2</a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="sl sl-icon-arrow-right"></i>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <!-- Pagination / End -->
          </div>

          <!-- Add Review Box -->
          <div id="add-review" class="add-review-box">
            <!-- Add Review -->
            <h3 class="listing-desc-headline margin-bottom-10">Добави отзив</h3>
            <p class="comment-notes">Твоят имейл няма да бъде побликуван</p>

            <!-- Subratings Container -->
            <div class="sub-ratings-container">
              <!-- Subrating #1 -->
              <div class="add-sub-rating">
                <div class="sub-rating-title">
                  Услуга
                  <i
                    class="tip"
                    data-tip-content="Quality of customer service and attitude to work with you"
                  ></i>
                </div>
                <div class="sub-rating-stars">
                  <!-- Leave Rating -->
                  <div class="clearfix"></div>
                  <form class="leave-rating">
                    <input type="radio" name="rating" id="rating-1" value="1" />
                    <label for="rating-1" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-2" value="2" />
                    <label for="rating-2" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-3" value="3" />
                    <label for="rating-3" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-4" value="4" />
                    <label for="rating-4" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-5" value="5" />
                    <label for="rating-5" class="fa fa-star"></label>
                  </form>
                </div>
              </div>

              <!-- Subrating #2 -->
              <div class="add-sub-rating">
                <div class="sub-rating-title">
                  Съотношение качество-цена
                  <i
                    class="tip"
                    data-tip-content="Overall experience received for the amount spent"
                  ></i>
                </div>
                <div class="sub-rating-stars">
                  <!-- Leave Rating -->
                  <div class="clearfix"></div>
                  <form class="leave-rating">
                    <input type="radio" name="rating" id="rating-11" value="1" />
                    <label for="rating-11" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-12" value="2" />
                    <label for="rating-12" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-13" value="3" />
                    <label for="rating-13" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-14" value="4" />
                    <label for="rating-14" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-15" value="5" />
                    <label for="rating-15" class="fa fa-star"></label>
                  </form>
                </div>
              </div>

              <!-- Subrating #3 -->
              <div class="add-sub-rating">
                <div class="sub-rating-title">
                  Местоположение
                  <i
                    class="tip"
                    data-tip-content="Visibility, commute or nearby parking spots"
                  ></i>
                </div>
                <div class="sub-rating-stars">
                  <!-- Leave Rating -->
                  <div class="clearfix"></div>
                  <form class="leave-rating">
                    <input type="radio" name="rating" id="rating-21" value="1" />
                    <label for="rating-21" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-22" value="2" />
                    <label for="rating-22" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-23" value="3" />
                    <label for="rating-23" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-24" value="4" />
                    <label for="rating-24" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-25" value="5" />
                    <label for="rating-25" class="fa fa-star"></label>
                  </form>
                </div>
              </div>

              <!-- Subrating #4 -->
              <div class="add-sub-rating">
                <div class="sub-rating-title">
                  Чистота
                  <i
                    class="tip"
                    data-tip-content="The physical condition of the business"
                  ></i>
                </div>
                <div class="sub-rating-stars">
                  <!-- Leave Rating -->
                  <div class="clearfix"></div>
                  <form class="leave-rating">
                    <input type="radio" name="rating" id="rating-31" value="1" />
                    <label for="rating-31" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-32" value="2" />
                    <label for="rating-32" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-33" value="3" />
                    <label for="rating-33" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-34" value="4" />
                    <label for="rating-34" class="fa fa-star"></label>
                    <input type="radio" name="rating" id="rating-35" value="5" />
                    <label for="rating-35" class="fa fa-star"></label>
                  </form>
                </div>
              </div>

              <!-- Uplaod Photos -->
              <div class="uploadButton margin-top-15">
                <input
                  class="uploadButton-input"
                  type="file"
                  name="attachments[]"
                  accept="image/*, application/pdf"
                  id="upload"
                  multiple
                />
                <label class="uploadButton-button ripple-effect" for="upload">Добави снимки</label>
                <span class="uploadButton-file-name"></span>
              </div>
              <!-- Uplaod Photos / End -->
            </div>
            <!-- Subratings Container / End -->

            <!-- Review Comment -->
            <form id="add-comment" class="add-comment">
              <fieldset>
                <div class="row">
                  <div class="col-md-6">
                    <label>Име:</label>
                    <input type="text" value />
                  </div>

                  <div class="col-md-6">
                    <label>Имейл:</label>
                    <input type="text" value />
                  </div>
                </div>

                <div>
                  <label>Отзив:</label>
                  <textarea cols="40" rows="3"></textarea>
                </div>
              </fieldset>

              <button class="button">Изпрати отзива</button>
              <div class="clearfix"></div>
            </form>
          </div>
          <!-- Add Review Box / End -->
        </div>

        <!-- Sidebar
        ==================================================-->
        <div class="col-lg-4 col-md-4 margin-top-75 sticky">
          <!-- Verified Badge -->
          <div
            class="verified-badge with-tip"
            data-tip-content="Listing has been verified and belongs the business owner or manager."
          >
            <i class="sl sl-icon-check"></i> Верифицирано
          </div>

          <!-- Book Now -->
          <!-- Book Now / End -->

          <!-- Coupon Widget -->
          <div
            class="coupon-widget"
            style="background-image: url(http://localhost/listeo_html/images/single-listing-01.jpg);"
          >
            <a href="#" class="coupon-top">
              <span class="coupon-link-icon"></span>
              <h3>Order 1 burger and get 50% off on second!</h3>
              <div class="coupon-valid-untill">Expires 25/10/2019</div>
              <div class="coupon-how-to-use">
                <strong>How to use?</strong> Just show us this coupon on a screen of your smartphone!
              </div>
            </a>
            <div class="coupon-bottom">
              <div class="coupon-scissors-icon"></div>
              <div class="coupon-code">L1ST30</div>
            </div>
          </div>

          <!-- Opening Hours -->
          <div class="boxed-widget opening-hours margin-top-35">
            <div class="listing-badge now-open">Верифициран</div>
            <h3>
              <i class="sl sl-icon-clock"></i> Работни часове
            </h3>
            <ul>
              <li>
                Понеделник
                <span>9 AM - 5 PM</span>
              </li>
              <li>
                Вторник
                <span>9 AM - 5 PM</span>
              </li>
              <li>
                Сряда
                <span>9 AM - 5 PM</span>
              </li>
              <li>
                Четвъртък
                <span>9 AM - 5 PM</span>
              </li>
              <li>
                Петък
                <span>9 AM - 5 PM</span>
              </li>
              <li>
                Събота
                <span>9 AM - 3 PM</span>
              </li>
              <li>
                Неделя
                <span>Затворено</span>
              </li>
            </ul>
          </div>
          <!-- Opening Hours / End -->

          <!-- Contact -->
          <div class="boxed-widget margin-top-35">
            <div class="hosted-by-title">
              <h4>
                <span>Създаден от</span>
                <a href="pages-user-profile.html">Tom Perrin</a>
              </h4>
              <a href="pages-user-profile.html" class="hosted-by-avatar">
                <img src="images/dashboard-avatar.jpg" alt />
              </a>
            </div>
            <ul class="listing-details-sidebar">
              <li>
                <i class="sl sl-icon-phone"></i> (123) 123-456
              </li>
              <!-- <li><i class="sl sl-icon-globe"></i> <a href="#">http://example.com</a></li> -->
              <li>
                <i class="fa fa-envelope-o"></i>
                <a href="#">tom@example.com</a>
              </li>
            </ul>

            <ul class="listing-details-sidebar social-profiles">
              <li>
                <a href="#" class="facebook-profile">
                  <i class="fa fa-facebook-square"></i> Facebook
                </a>
              </li>
              <!-- <li>
								<a href="#" class="twitter-profile">
									<i class="fa fa-twitter"></i> Twitter
								</a>
              </li>-->
              <!-- <li><a href="#" class="gplus-profile"><i class="fa fa-google-plus"></i> Google Plus</a></li> -->
            </ul>

            <!-- Reply to review popup -->
            <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
              <div class="small-dialog-header">
                <h3>Изпрати съобщение</h3>
              </div>
              <div class="message-reply margin-top-0">
                <textarea cols="40" rows="3" placeholder="Your message to Tom"></textarea>
                <button class="button">Изпрати съобщение</button>
              </div>
            </div>

            <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim">
              <i class="sl sl-icon-envelope-open"></i> Изпрати съобщение
            </a>
          </div>
          <!-- Contact / End-->

          <!-- Share / Like -->
          <div class="listing-share margin-top-40 margin-bottom-40 no-border">
            <span>159 души са маркирали тази обява</span>

            <!-- Share Buttons -->
            <ul class="share-buttons margin-top-40 margin-bottom-0">
              <li>
                <a class="fb-share" href="#">
                  <i class="fa fa-facebook"></i> Сподели
                </a>
              </li>
              <li>
                <a class="twitter-share" href="#">
                  <i class="fa fa-twitter"></i> Tweet
                </a>
              </li>
              <li>
                <a class="gplus-share" href="#">
                  <i class="fa fa-google-plus"></i> Сподели
                </a>
              </li>
              <!-- <li><a class="pinterest-share" href="#"><i class="fa fa-pinterest-p"></i> Pin</a></li> -->
            </ul>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- Sidebar / End -->
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";

export default {
  props: ["id"],
  data() {
    return {
      project: []
    };
  },
  mounted() {
    this.getProject();

    $(".mfp-gallery-container").each(function() {
      // the containers for all your galleries
      $(this).magnificPopup({
        type: "image",
        delegate: "a.mfp-gallery",

        fixedContentPos: true,
        fixedBgPos: true,

        overflowY: "auto",

        closeBtnInside: false,
        preloader: true,

        removalDelay: 0,
        mainClass: "mfp-fade",

        gallery: { enabled: true, tCounter: "" }
      });
    });
  },
  methods: {
    getProject() {
      window.axios.get("/projects/get/" + this.id).then(({ data }) => {
        this.project = data;
      });
    }
  },
  components: {}
};
</script>
