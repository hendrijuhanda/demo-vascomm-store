"use client";

// @ts-ignore
import Slider from "react-slick";
import { InnerWrapper } from "@/components/ui/layouts";
import Image from "next/image";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import { useRef, useState } from "react";
import { MdChevronLeft, MdChevronRight } from "react-icons/md";

export const Banner = () => {
  let sliderRef = useRef(null);

  const [currentSlide, setCurrentSlide] = useState<number>(0);

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
    slidesToShow: 1,
    slidesToScroll: 1,
    afterChange: (current: number) => setCurrentSlide(current),
  };

  return (
    <section className="my-8 pb-8">
      <InnerWrapper>
        <div>
          <Slider
            ref={(slider: any) => {
              sliderRef = slider;
            }}
            {...settings}
          >
            {Array.from(Array(5).keys()).map((n) => (
              <div key={n}>
                <Image
                  src="/banner.png"
                  width={2012}
                  height={662}
                  alt="banner"
                />
              </div>
            ))}
          </Slider>
        </div>

        <div className="mt-4 flex items-center">
          <div
            className={`text-2xl cursor-pointer text-gray-500 transition-opacity ${
              currentSlide === 0 && "!cursor-default opacity-50"
            }`}
            onClick={previous}
          >
            <MdChevronLeft />
          </div>

          {Array.from(Array(5).keys()).map((n) => (
            <div className="mx-2" key={n}>
              <div
                className={`w-2 h-2 rounded-full bg-gray-300 transition-colors ${
                  currentSlide === n && "!bg-stone-400"
                }`}
              ></div>
            </div>
          ))}

          <div
            className={`text-2xl cursor-pointer text-gray-500 transition-opacity ${
              currentSlide === 4 && "!cursor-default opacity-50"
            }`}
            onClick={next}
          >
            <MdChevronRight />
          </div>
        </div>
      </InnerWrapper>
    </section>
  );
};
