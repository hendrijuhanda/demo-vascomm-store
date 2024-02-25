import { playfairDisplay } from "@/components/ui/fonts";
import { InnerWrapper } from "@/components/ui/layouts";
import { Product } from ".";
import { Button } from "@/components/ui/buttons";

export const AvailableProducts = () => {
  const items = Array.from(Array(8).keys());

  return (
    <section className="my-8 pb-8">
      <InnerWrapper>
        <h3 className={`${playfairDisplay.className} text-2xl font-bold mb-4`}>
          Produk Tersedia
        </h3>

        <div className="grid grid-cols-5 mb-4">
          {items.map((n) => (
            <div className="p-2" key={n}>
              <Product
                imageUrl="/product-2.png"
                name="Exodia"
                price={9000000}
              />
            </div>
          ))}
        </div>

        <div className="flex justify-center">
          <Button label="Lihat lebih banyak" color="primary-inverse" />
        </div>
      </InnerWrapper>
    </section>
  );
};
