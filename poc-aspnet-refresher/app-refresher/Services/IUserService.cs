using app_refresher.Models;

namespace app_refresher.Services;

public interface IUserService
{
    Task<User?> AuthenticateAsync(string username, string password);
    Task<User?> GetByIdAsync(int id);
    Task<bool> UpdateAsync(User updatedUser);
}
