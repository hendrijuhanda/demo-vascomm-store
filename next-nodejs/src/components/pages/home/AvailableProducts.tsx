"use client";

import { playfairDisplay } from "@/components/ui/fonts";
import { InnerWrapper } from "@/components/ui/layouts";
import { Product } from ".";
import { Button } from "@/components/ui/buttons";
import { useCallback, useEffect, useMemo, useState } from "react";

export const AvailableProducts = () => {
  const [isFetched, setIsFetched] = useState<boolean>();
  const [isFetching, setIsFetching] = useState<boolean>();
  const [items, setItems] = useState<any[]>([]);
  const [pagination, setPagination] = useState<any>({});

  useEffect(() => {
    fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/client/products?${new URLSearchParams(
        {
          sort: "created_at,desc",
          page: "1",
          per_page: "10",
        }
      )}`
    )
      .then((res) => res.json())
      .then((body) => {
        setIsFetched(true);
        setItems(body.data.items);
        setPagination(body.data.pagination);
      })
      .catch((e) => {});
  }, []);

  const isAll = useMemo(
    () => Number(pagination.total) === items.length,
    [pagination.total, items]
  );

  const more = useCallback(() => {
    setIsFetching(true);

    fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/client/products?${new URLSearchParams(
        {
          sort: "created_at,desc",
          page:
            Number(pagination.current_page) < 3
              ? "3"
              : String(Number(pagination.current_page) + 1),
          per_page: "5",
        }
      )}`
    )
      .then((res) => res.json())
      .then((body) => {
        setIsFetched(true);
        setItems((prev) => [...prev, ...body.data.items]);
        setPagination(body.data.pagination);
        setIsFetching(false);
      })
      .catch((e) => {
        setIsFetching(false);
      });
  }, [pagination.current_page, isFetching]);

  return (
    <section className="my-8 pb-8">
      {isFetched && (
        <InnerWrapper>
          <h3
            className={`${playfairDisplay.className} text-2xl font-bold mb-4`}
          >
            Produk Tersedia
          </h3>

          <div className="grid grid-cols-5 mb-4">
            {items.map((item, n) => (
              <div className="p-2" key={n}>
                <Product
                  imageUrl={item.image_url}
                  name={item.name}
                  price={item.price}
                />
              </div>
            ))}
          </div>

          <div className="flex justify-center">
            {!isFetching
              ? !isAll && (
                  <Button
                    label="Lihat lebih banyak"
                    color="primary-inverse"
                    onClick={more}
                  />
                )
              : "Loading..."}
          </div>
        </InnerWrapper>
      )}
    </section>
  );
};
