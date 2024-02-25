import { playfairDisplay } from "@/components/ui/fonts";
import Image from "next/image";

export interface ProductProps {
  imageUrl: string;
  name: string;
  price: string | number;
}

export const Product = (props: ProductProps) => {
  return (
    <div className="hover:drop-shadow-xl border border-white hover:border-gray-300 bg-white cursor-pointer">
      <div>
        <Image src={props.imageUrl} width={183} height={183} alt={props.name} />
      </div>
      <div className="p-4">
        <div className={`${playfairDisplay.className} font-bold`}>
          {props.name}
        </div>
        <div className="text-primary-500 font-bold">IDR {props.price}</div>
      </div>
    </div>
  );
};
