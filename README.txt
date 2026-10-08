--Project phát triển theo 2 design patterns: Repository và Service ()
    + Repository: Là lớp trừu tượng hóa việc tương tác với cơ sở dữ liệu. 
      Nhiệm vụ của Repository là thực hiện các thao tác như thêm, sửa, xóa, và tìm kiếm dữ liệu trong cơ sở dữ liệu. 
      Repository sẽ nhận và xử lý dữ liệu trước khi lưu vào cơ sở dữ liệu.
    + Service: Là lớp chứa logic nghiệp vụ của ứng dụng. Service sử dụng Repository để truy xuất và thao tác với dữ liệu, đồng thời thực hiện các quy tắc nghiệp vụ phức tạp. 
      Service thường được gọi từ Controller để xử lý các yêu cầu từ người dùng (client).
 - Thứ tự xử lý:
      Repository <- 2. Service <- 3. Controller
 - Giải thích:
   1. Controller nhận yêu cầu từ client và gọi đến Service để thực hiện các nghiệp vụ được yêu cầu.
   2. Service sau đó sẽ gọi đến Repository để tương tác với cơ sở dữ liệu và hoàn tất xử lý.

* Luồng xử lý dữ liệu 
    1. tạo bảng -> migration, seeders
    2. tạo routes (web, api)
    3. tạo controller
    4. tạo model -> khai báo quan hệ (nếu có)
    5. tạo reponsitory (cả interface)
    6. tạo services (cả interface)
    7. khai báo provider (service và reponsitory) 
    8. tạo request (nếu cần)
    9. tạo view

    

