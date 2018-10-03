/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */

/*
 * ModelUserCreate.h
 * 
 * 
 */

#ifndef ModelUserCreate_H_
#define ModelUserCreate_H_

#include <QJsonObject>


#include <QDateTime>
#include <QString>

#include "SWGObject.h"

namespace api {

class ModelUserCreate: public SWGObject {
public:
    ModelUserCreate();
    ModelUserCreate(QString* json);
    virtual ~ModelUserCreate();
    void init();
    void cleanup();

    QString asJson ();
    QJsonObject* asJsonObject();
    void fromJsonObject(QJsonObject &json);
    ModelUserCreate* fromJson(QString &jsonString);

    qint64 getId();
    void setId(qint64 id);

    qint64 getRoleId();
    void setRoleId(qint64 role_id);

    qint64 getCompanyId();
    void setCompanyId(qint64 company_id);

    QString* getRfid();
    void setRfid(QString* rfid);

    QString* getUsername();
    void setUsername(QString* username);

    QString* getPassword();
    void setPassword(QString* password);

    QString* getConfirmPassword();
    void setConfirmPassword(QString* confirm_password);

    QString* getEmail();
    void setEmail(QString* email);

    QString* getFullname();
    void setFullname(QString* fullname);

    QDateTime* getBirthday();
    void setBirthday(QDateTime* birthday);

    QString* getAddress();
    void setAddress(QString* address);

    QString* getSidn();
    void setSidn(QString* sidn);

    qint32 getGender();
    void setGender(qint32 gender);

    QString* getPhone();
    void setPhone(QString* phone);


private:
    qint64 id;
    qint64 role_id;
    qint64 company_id;
    QString* rfid;
    QString* username;
    QString* password;
    QString* confirm_password;
    QString* email;
    QString* fullname;
    QDateTime* birthday;
    QString* address;
    QString* sidn;
    qint32 gender;
    QString* phone;
};

}

#endif /* ModelUserCreate_H_ */