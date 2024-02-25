"use client";

import { playfairDisplay } from "@/components/ui/fonts";
import { InnerWrapper } from "@/components/ui/layouts";

// @ts-ignore
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import { useRef, useState } from "react";
import { MdChevronLeft, MdChevronRight } from "react-icons/md";
import { Product } from ".";

export const LatestProducts = () => {
  let sliderRef = useRef(null);

  const [currentSlide, setCurrentSlide] = useState<number>(0);

  const items = Array.from(Array(10).keys());

  const next = () => {
    // @ts-ignore
    sliderRef.slickNext();
  };

  const previous = () => {
    // @ts-ignore
    sliderRef.slickPrev();
  };

  const settings = {
    infinite: false,
    lazyLoad: true,
    speed: 500,
    slidesToShow: 5,
    slidesToScroll: 1,
    afterChange: (current: number) => setCurrentSlide(current),
  };

  return (
    <section className="my-8">
      <InnerWrapper>
        <h3 className={`${playfairDisplay.className} text-2xl font-bold mb-4`}>
          Terbaru
        </h3>

        <div className="relative">
          <Slider
            ref={(slider: any) => {
              sliderRef = slider;
            }}
            {...settings}
          >
            {items.map(() => (
              <div className="px-2 pb-8">
                <Product
                  imageUrl="/product-1.png"
                  name="Exodia"
                  price={9000000}
                />
              </div>
            ))}
          </Slider>

          {currentSlide !== 0 && (
            <div
              className="absolute top-[50%] -mt-10 -ml-16 w-20 h-20 flex items-center justify-center text-5xl cursor-pointer"
              onClick={previous}
            >
              <MdChevronLeft />
            </div>
          )}

          {currentSlide !== items.length - 5 && (
            <div
              className="absolute top-[50%] right-0 -mt-10 -mr-16 w-20 h-20 flex items-center justify-center text-5xl cursor-pointer"
              onClick={next}
            >
              <MdChevronRight />
            </div>
          )}
        </div>
      </InnerWrapper>
    </section>
  );
};
