import { InnerWrapper } from "@/components/ui/layouts";
import { Logo } from ".";
import {
  TiSocialFacebook,
  TiSocialInstagram,
  TiSocialTwitter,
} from "react-icons/ti";
import { playfairDisplay } from "@/components/ui/fonts";
import Link from "next/link";

export const Company = () => {
  return (
    <div>
      <div className="flex justify-center mb-10">
        <Logo />
      </div>

      <div className="text-center text-gray-300 mb-10">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut commodo in
        vestibulum, sed dapibus tristique nullam.
      </div>

      <div className="flex justify-center items-center text-4xl text-primary-500">
        <div className="mx-2">
          <TiSocialFacebook />
        </div>

        <div className="mx-2">
          <TiSocialTwitter />
        </div>

        <div className="mx-2">
          <TiSocialInstagram />
        </div>
      </div>
    </div>
  );
};

const Navs = () => {
  const navs = [
    {
      title: "Layanan",
      items: ["Bantuan", "Tanya Jawab", "Hubungi Kami", "Cara Berjualan"],
    },
    {
      title: "Tentang Kami",
      items: [
        "About Us",
        "Karir",
        "Blog",
        "Kebijakan Privasi",
        "Syarat dan Ketentuan",
      ],
    },
    {
      title: "Mitra",
      items: ["Supplier"],
    },
  ];

  return (
    <div className="grid grid-cols-3 gap-4">
      {navs.map((item, index) => (
        <div key={index}>
          <div>
            <h4
              className={`${playfairDisplay.className} mb-4 text-lg font-bold`}
            >
              {item.title}
            </h4>
          </div>

          <ul>
            {item.items.map((val, n) => (
              <li
                key={n}
                className={`text-sm ${
                  n !== item.items.length - 1 ? "mb-4" : undefined
                }`}
              >
                <Link href="/" className="uppercase">
                  {val}
                </Link>
              </li>
            ))}
          </ul>
        </div>
      ))}
    </div>
  );
};

export const Footer = () => {
  return (
    <footer className="border-t">
      <InnerWrapper>
        <div className="flex py-24">
          <div className="w-1/3">
            <Company />
          </div>

          <div className="pl-16 flex-grow">
            <Navs />
          </div>
        </div>
      </InnerWrapper>

      <div className="w-full h-8 bg-primary-200"></div>
    </footer>
  );
};
