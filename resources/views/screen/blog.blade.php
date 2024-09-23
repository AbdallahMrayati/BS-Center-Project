@extends('layouts.app')

@section('title')
    {{ config('app.name', 'BSC') }} | Blogs
@endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="about-header container">
            <ul>
                <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                <img src="{{ asset('assets/icons/arrow.svg') }}" />
                <li>{{ $blog->slug }}</li>
            </ul>
        </div>
    </div>

    <section class="hero-single-blog">
        <img src="{{ asset('assets/imgs/bg-blog.webp') }}" alt="{{ $blog->image_alt }}" />
    </section>

    <section class="blog-details">
        <div class="container">
            <div class="blog-details-title">
                <h3>
                    {{ $blog->h1 }}
                </h3>
                <div class="date">
                    <img src="{{ asset('assets/icons/calender.svg') }}" alt="" />
                    <span>{{ $blog->created_at }}</span>
                </div>
            </div>
            <p>
                {{ $blog->description }}
            </p>
        </div>
    </section>

    <section class="blog-cards container">
        <div class="blog-card-title">
            <h2>Related Blog</h2>
            <a href="{{ route('blogs.index') }}">see all</a>
        </div>
        <div class="card-container-blog container">
            @foreach ($blogsByTag as $item)
                <div class="card-blogs">
                    <img src="/assets/imgs/card-blog.png" alt="{{ $item['title'] }}" class="card-blog-img" />
                    <div class="card-blog-content">
                        <h3>
                            {{ $item['title'] }}
                        </h3>
                        <div class="card-blog-desc">
                            @if (strlen($item->description) > 125)
                                <p>{{ Str::limit($item->description, 125, '...') }}</p>
                                <a href="{{ route('blog.show', $item->slug) }}">more</a>
                            @else
                                <p>{{ $item->description }}</p>
                            @endif
                        </div>
                        <div class="card-blog-footer">
                            <button><a href="{{ route('blog.show', $item->slug) }}">Read more</a></button>
                            <div class="card-blog-views">
                                <img src="../assets/icons/view.svg" alt="" />
                                <span>{{ $item['number_of_views'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

{{-- @section('scripts')
    <script>
        // Pass the tag_name dynamically from the Blade template to JavaScript
        const tag = @json($blog->tag_name);
        console.log("tag: ", tag);

        document.addEventListener("DOMContentLoaded", async function() {

            // Fetch related blogs from the API
            const response = await fetch(`/blogs/get-related-blogs/${tag}`);
            const result = await response.json();

            const data = result.blogs.map(blog => ({
                img: blog.image_url ||
                "/assets/imgs/card-blog.png", // Fallback image if none is provided
                title: blog.title,
                desc: blog.description,
                viewNum: blog.number_of_views,
                link: `/blog/${blog.slug}`,
            }));

            // Create and append blog cards dynamically
            data.forEach((item) => {
                const card = document.createElement("div");
                card.classList.add("card-blogs");

                card.innerHTML = `
        <img src="${item.img}" alt="${item.title}" class="card-blog-img">
        <div class="card-blog-content">
          <h3>${item.title}</h3>
          <div class="card-blog-desc">
            ${
              item.desc.length > 125
                ? `<p>${item.desc.substring(0, 125)}...</p>
                      <a href='${item.link}'>more</a>`
                : `<p>${item.desc}</p>`
            }
          </div>
          <div class="card-blog-footer">
            <button><a href='${item.link}'>Read more</a></button>
            <div class="card-blog-views">
              <img src="/assets/icons/view.svg" alt="Views icon">
              <span>${item.viewNum}</span>
            </div>
          </div>
        </div>
      `;

                document.querySelector(".card-container-blog").appendChild(card);
            });
        });
    </script> --}}
